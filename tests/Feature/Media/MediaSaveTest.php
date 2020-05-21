<?php

namespace Tests\Feature\Media;

use App\Media;
use App\Services\SaveFile;
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

        $mediaSave = new SaveFile();
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
        $mediaSave = new SaveFile();
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
        $mediaSave = new SaveFile();
        $data = $mediaSave->handel($image, 'avatars', $name, $disc, $visibility );

        // перевірка доступу до збереженого файла
        Storage::disk($disc)->assertExists($data['path']);
        // перевірка видимості збереженого файла з налаштуваннями
        $this->assertTrue(Storage::disk($disc)->getVisibility($data['path']) == $visibility);

        // Збереження файла до бд і отримання id медіа
        $media = new Media(array_merge($data, ['Some File', 'keywords', 'description']));
        $media->save();

        // перевірка чи існує такий файл в бд
        $this->assertTrue((boolean)$media);
        // перевірка чи існує такий файл на диску
        Storage::disk($disc)->assertExists(Media::find($media->id)->path);

    }

    public function test_delete_file()
    {
        // setup
        $disc = 'public';
        $image = UploadedFile::fake()->image('avatar.jpg', 100, 100)->size(1000);
        // збереження файду на диск і отримання інформації про нього
        $mediaSave = new SaveFile();
        $data = $mediaSave->handel($image, 'tests');
        // перевірка доступу до збереженого файла
        Storage::disk($disc)->assertExists($data['path']);
        // end setup

        // deleting

        $returnBoolean = ! Storage::disk($disc)->exists($data['path']) ?? Storage::disk($disc)->delete($data['path']);


        // перевірка ркзультату видалення файла
        $this->assertTrue($returnBoolean);
        // перевірка доступу до не існуючого файла
        Storage::disk($disc)->assertMissing($data['path']);
    }

    public function test_delete_file_from_db_and_storage()
    {
        // setup
        $disc = 'public';
        $image = UploadedFile::fake()->image('avatar.jpg', 100, 100)->size(1000);
        // збереження файду на диск і отримання інформації про нього
        $mediaSave = new SaveFile();
        $data = $mediaSave->handel($image, 'tests');
        // перевірка доступу до збереженого файла
        Storage::disk($disc)->assertExists($data['path']);

        // Збереження файла до бд і отримання id медіа
        $media = new Media(array_merge($data, ['Some File', 'keywords', 'description']));
        $media->save();
        // перевірка чи існує такий файл в бд
        $this->assertTrue((boolean)$media);
        // end setup

        // deleting
        $media = Media::findOrFail($media->id);
        $result = $media->delete();

        // перевірка чи не існує такий файл в бд
        $this->assertFalse((boolean)Media::find($media->id));
        // перевірка ркзультату видалення файла
        $this->assertTrue((boolean)$result);
        // перевірка доступу до не існуючого файла
        Storage::disk($disc)->assertMissing($data['path']);
    }
}
