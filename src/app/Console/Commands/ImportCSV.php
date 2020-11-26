<?php

namespace App\Console\Commands;

use App\Models\Collection;
use App\Models\Label;
use App\Models\LabelText;
use App\Models\Segment;
use Illuminate\Console\Command;
use Storage;

class ImportCSV extends Command
{
    /**
    * The name and signature of the console command.
    *
    * @var string
    */
    protected $signature = 'import:csv-file';

    /**
    * The console command description.
    *
    * @var string
    */
    protected $description = 'This command will import into the application the content of the CSV.';

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
    * @return mixed
    */
    public function handle()
    {
        $files = array_filter(
            Storage::disk('csv_fmp_fd_2020')->files(),
      // Only csv's
      function ($item) {
          return strpos($item, '.csv');
      }
        );

        foreach ($files as $file) {
            $collection = Collection::firstOrCreate(
                ['name' => $file],
            );
            $collection->users()->attach('1', ['role' => 'admin']);

            $Arr = $this->csvToArray($file);

            for ($x = 0; $x < count($Arr['data']); $x ++) {
                if ($x % 100 == 0) {
                    $this->error('sleeping ... 2');
                    sleep(2);
                }
                $this->info($Arr[$x]['Auteur et titre']);

                $collection->texts()->firstOrCreate(
                    [
            'name' => $Arr[$x]['Auteur et titre'],
            'uploader_id' => 1,
            'abstract' => $Arr[$x]['reftot'],
          ]
                );

                // LabelText::firstOrCreate($Arr[$i]);
        // Segment::firstOrCreate($Arr[$i]);
            }

            // Label::firstOrCreate($Arr[$i]);
        }

        $this->info('Job is done.');
    }

    private function csvToArray($filename = '', $delimiter = ';')
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        $error_count = 0;
        $success_count = 0;

        $header = null;

        $data = array();

        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header) {
                    $header = $row;
                } elseif (count($row) == count($header)) {
                    $data[] = array_combine($header, $row);
                    $success_count++;
                } else {
                    $this->error(count($row) . '!=' . count($header));
                    $this->error('error');
                    $error_count++;
                }
            }
            fclose($handle);
        }

        $this->error('error count: ' . $error_count);
        $this->info('success count: ' . $success_count);

        return response()->json([
      'header' => $header,
      'data' => $data,
    ]);
        // return $data;
    }
}
