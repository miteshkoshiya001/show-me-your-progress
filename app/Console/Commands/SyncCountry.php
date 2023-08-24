<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncCountry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:country';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import countries, states, cities in database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    
    public function handle()
    {
        $dbHost  = 'localhost';
        $dbName = 'minimall';
        $dbPass  = '';
        $dbUser  = 'root';
        $files   = ['conutry-state-city.sql'];
        // dd($files);
        $publicPath = public_path();
        foreach($files as $key => $file){
            $filePath = $publicPath.'/database/'.$file;
            if(file_exists($filePath)){
                $this->importDatabaseTables($dbHost, $dbUser, $dbPass, $dbName, $filePath);
            }
        }
        return Command::SUCCESS;
    }
    
    function importDatabaseTables($dbHost, $dbUname, $dbPass, $dbName, $filePath){
        // Connect & select the database
        $db = new \mysqli($dbHost, $dbUname, $dbPass, $dbName); 
    
        // Temporary variable, used to store current query
        $templine = '';
        
        // Read in entire file
        $lines = file($filePath);
        
        $error = '';
        
        // Loop through each line
        foreach ($lines as $line){
            // Skip it if it's a comment
            if(substr($line, 0, 2) == '--' || $line == ''){
                continue;
            }
            
            // Add this line to the current segment
            $templine .= $line;
            
            // If it has a semicolon at the end, it's the end of the query
            if (substr(trim($line), -1, 1) == ';'){
                // Perform the query
                if(!$db->query($templine)){
                    $error .= 'Error importing query "<b>' . $templine . '</b>": ' . $db->error . '<br /><br />';
                }
                
                // Reset temp variable to empty
                $templine = '';
            }
        }
        return !empty($error)?$error:true;
    }
}
