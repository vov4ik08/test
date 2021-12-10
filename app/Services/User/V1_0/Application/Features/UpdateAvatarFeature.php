<?php


namespace App\Services\User\V1_0\Application\Features;


use App\Services\User\V1_0\Domain\Jobs\UpdateUserAvatarJob;
use App\Services\User\V1_0\Domain\Requests\UpdateAvatarRequest;
use Hashids\Hashids;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Lucid\Units\Feature;
use function config;

class UpdateAvatarFeature extends Feature
{
    public function handle(UpdateAvatarRequest $request)
    {
        $hashids = new Hashids();
        $user = Auth::user();
        $avatar = $request->input('avatar');
        $s3 = Storage::disk('s3');
        $version = $user['avatar_version'] + 1;
        $fileName = "/avatar_" . $version;


        file_put_contents(sys_get_temp_dir() . "/$fileName.png", base64_decode($avatar));

        $filePath = "/user/avatar/" . $hashids->encode($user->id) . "/s0/" . "00_" . $version . ".png";

        $s3->put($filePath, base64_decode($avatar), 'public');

        $imageConfig = config('image');
        foreach ($imageConfig['avatar']['sizes'] as $name => $size) {
            $imageResize = Image::make(sys_get_temp_dir() . "/$fileName.png");
            $imageResize->orientate()->fit($size[0], $size[1])->save(sys_get_temp_dir() . "/" . $fileName . $name . ".png");
            $filePath = "/user/avatar/" . $hashids->encode($user->id) . "/$name/" . $fileName . ".png";

            $s3->put($filePath, file_get_contents(sys_get_temp_dir() . "/" . $fileName . $name . ".png"), 'public');
        }


        return $this->run(UpdateUserAvatarJob::class);

    }
}
