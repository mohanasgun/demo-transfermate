<?php

namespace App\Console\Commands;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

use function Psy\info;

class SyncListData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:list_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to sync authors and books from xml file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $files = $this->getFiles();
        collect($files)->map(function ($file) {
            //Read data from xml files.
            $xmlString = file_get_contents($file);
            
            //Convert all the data in xml file as array.
            $lists = json_decode(json_encode(simplexml_load_string($xmlString)), true);
            collect(Arr::first($lists))->map(function ($list) {
                $this->updateOrCreateData($list);
            });
        });
    }

    /**
     * Fetch files to procss
     *
     * @return array
     */
    public function getFiles()
    {
        // Fetch all the files of xml-data folder.
        $files = array_filter(glob(storage_path('xml-data/*')), 'is_file');

        //Fetch all the sub directories of xml-data folder.
        $subFolders = array_filter(glob(storage_path('xml-data/*')), 'is_dir');

        //Fetch all the files of xml-data sub directories.
        $subFolderFiles = collect($subFolders)->map(function ($subFolder) {
            return array_filter(glob($subFolder . '/*'), 'is_file');
        })->all();

        return Arr::flatten(array_merge($files, $subFolderFiles));
    }

    /**
     * update or create authors and books
     *
     * @param array $list
     * @return void
     */
    public function updateOrCreateData($list)
    {
        // Update or create authors table.
        $author = Author::updateOrCreate([
            'name' => $list['author']
        ]);

        // Update or create books table.
        Book::updateOrCreate([
            'name' => $list['name'],
            'author_id' => $author->id
        ]);
    }
}
