<?php

namespace Tests\Feature\Media;

use App\Media;
use App\Services\Media\SaveMediaFile;
use App\Services\Media\SaveToDbMediaFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MediaSaveTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_function_save_fake_image_to_avatars_without_name()
    {
        $disc = 'public';
        $visibility = 'public';
        $name = '';
        $image = UploadedFile::fake()->image('avatar.jpg', 100, 100)->size(1000);

        $mediaSave = new SaveMediaFile();
        $data = $mediaSave->handel($image, 'avatars', $name, $disc, $visibility );


        // Assert the file was stored...
        Storage::disk($disc)->assertExists($data['path']);
        // Assert a file does not exist...
        Storage::disk($disc)->assertMissing('missing.jpg');
        $this->assertTrue(Storage::disk($disc)->getVisibility($data['path']) == $visibility);
        dump($data);
    }

    /**
     * A basic feature test example.
     *
    * @return void
    */
    public function test_function_save_fake_image_to_avatars_with_name()
    {
        // default data
        $disc = 'public';
        $visibility = 'public';
        $name = 'testname.jpeg';
        $image = UploadedFile::fake()->image('avatar.jpg', 100, 100)->size(1000);

        // збереження файду на диск і отримання інформації про нього
        $mediaSave = new SaveMediaFile();
        $data = $mediaSave->handel($image, 'avatars', $name, $disc, $visibility );

        // перевірка імені файла
        $this->assertTrue($data['name'] == $name);
        // перевірка доступу до збереженого файла
        Storage::disk($disc)->assertExists($data['path']);
        // перевірка доступу до не існуючого файла
        Storage::disk($disc)->assertMissing('missing.jpg');
        // перевірка видимості збереженого файла з налаштуваннями
        $this->assertTrue(Storage::disk($disc)->getVisibility($data['path']) == $visibility);
//        dump($data);
    }

    public function test_file_to_data_base()
    {
        // default data
        $disc = 'public';
        $visibility = 'public';
        $name = 'testname.jpeg';
        $image = UploadedFile::fake()->image('avatar.jpg', 100, 100)->size(1000);

        // збереження файду на диск і отримання інформації про нього
        $mediaSave = new SaveMediaFile();
        $data = $mediaSave->handel($image, 'avatars', $name, $disc, $visibility );

        // перевірка доступу до збереженого файла
        Storage::disk($disc)->assertExists($data['path']);
        // перевірка видимості збереженого файла з налаштуваннями
        $this->assertTrue(Storage::disk($disc)->getVisibility($data['path']) == $visibility);

        // Збереження файла до бд і отримання id медіа
        $saveMethod = new SaveToDbMediaFile();
        $mediaId = $saveMethod->handel($data, 'Some File', 'keywords', 'description');
        // перевірка чи існує такий файл в бд
        $this->assertTrue((boolean)$mediaId);
        // перевірка чи існує такий файл на диску
        Storage::disk($disc)->assertExists(Media::find($mediaId)->path);

    }
}
