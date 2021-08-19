<?php
declare( strict_types = 1 );

use Illuminate\Database\Seeder;
use App\Shared\File;

class BookEloquentJavaScriptSeed extends Seeder
{

    private $id = 1; #debe ser unico en base de datos
    private $slug = 'eloquent-javascript'; #max 50
    private $name = 'Eloquent JavaScript'; #max 100
    private $folder = 'EloquentJavaScript'; #max 50
    private $imagen_prefix = 'page-{{NUMBER}}.png'; #max 50

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() :void
    {
        $book_contents = $this->data();

        $pdo = DB::connection()->getPdo();

        DB::transaction(function () use($book_contents) {

            DB::table('books')->where('id',$this->id)->delete();

            DB::table('books')->insert([
                'id' => $this->id,
                'slug' => $this->slug,
                'name' => $this->name,
                'folder' => $this->folder,
                'imagen_prefix' => $this->imagen_prefix,
            ]);

            #la tabla book_contents borra en cascada

            DB::table('book_contents')->insert($book_contents);
        });
    }

    /**
    * return array | data insert book_contents
    */
    private function data() :array
    {   
        $book_contents = [];
        
        $path = storage_path('books').'/'.$this->folder;
        
        $metadata = $this->exists($path.'/metadata.json');
        
        $pages = $this->exists($path.'/pages');
        
        $pdf = $this->exists($path.'/book.pdf');
        
        $metadata = json_decode(file_get_contents($metadata));

        $count = 1;
        
        #se asigna la metadata del libro
        foreach ($metadata as $value) {

            #si no existe una pagina la creo vacia, asi 
            if($count!==$value->page){
                array_push($book_contents, [
                    'book_id' => $this->id,
                    'page' => $count,
                    'text_content' => null
                ]);
                $count++;
            }

            #agrego pagina correspondiente
            array_push($book_contents, [
                'book_id' => $this->id,
                'page' => $count,
                'text_content' => utf8_encode($value->text_content),
            ]);
            $count++;
        }

        #se asigna la imagen del libro
        foreach ($book_contents as &$value) {
            
            $page_pad = str_pad((string) $value['page'], 3, '0', STR_PAD_LEFT);

            $value['image'] =  str_replace('{{NUMBER}}', $page_pad, $this->imagen_prefix);
        }

        return $book_contents;
    }

    /**
    * valido la existencia de los archivos y carpetas necesarios
    * return path string
    */
    private function exists(string $path) :string
    {
        if(false === File::exists($path)){

            echo "Error No existe: $path \n"; die;
        }
        return $path;
    }
}