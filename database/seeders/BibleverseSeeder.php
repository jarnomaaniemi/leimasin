<?php

namespace Database\Seeders;

use App\Models\Bibleverse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BibleverseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bibleverse::truncate();

        $xmlDataString = file_get_contents('database/csv/R1933.xml');
        $xmlObject = simplexml_load_string($xmlDataString);
        $json= json_encode($xmlObject);
        $array = json_decode($json, true);
        $books = $array['BIBLEBOOK'];
        // dd($books[39]['CHAPTER'][17]);
            
        array_map(function ($book) {
            $chapters = $book['CHAPTER'];
            
            array_map(function ($chapter) use ($book) {
                if (!isset($chapter['VERS'])) {
                    $verses = $book['CHAPTER']['VERS'];
                    $chapterNumber = $book['CHAPTER']['@attributes']['cnumber'];
                } else {
                    $verses = $chapter['VERS'];
                    $chapterNumber = $chapter['@attributes']['cnumber'];
                }
                
                foreach ($verses as $index => $verse) {
                    if(gettype($verse) === 'array') {
                        continue;
                    }

                    Bibleverse::create([
                        'book_number' => $book['@attributes']['bnumber'],
                        'book_name' => $book['@attributes']['bname'],
                        'book_short' => $book['@attributes']['bsname'],
                        'chapter' => $chapterNumber,
                        'verse' => (string) ($index + 1),
                        'verse_text' => $verse
                    ]);
                    // dd($row);
                }

            }, $chapters);
            
            // return $chaptersData;

        }, $books);

        // $csvData = fopen(base_path('database/csv/bibleverses.csv'), 'r');
        // $transRow = true;

        // while (($data = fgetcsv($csvData, 555, '|')) !== false) {
        //     if (!$transRow) {
        //         Bibleverse::create([
        //             'book_number' => $data['1'],
        //             'book_name' => $data['2'],
        //             'book_short' => $data['3'],
        //             'chapter' => $data['4'],
        //             'verse' => $data['5'],
        //             'verse_text' => $data['6'],
        //         ]);
        //     }
        //     $transRow = false;
        // }
        // fclose($csvData);
    }
}
