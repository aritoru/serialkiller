<?php

class serialInsertSerieTask extends sfBaseTask
{

  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
        new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
        new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
        new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
        new sfCommandOption('series', null, sfCommandOption::PARAMETER_REQUIRED, 'The series name')
        // add your own options here
    ));

    $this->namespace = 'serial';
    $this->name = 'insertSerie';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [serial:insertSerie|INFO] task does things.
Call it with:

  [php symfony serial:insertSerie|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    include_once (sfConfig::get('sf_lib_dir').'/vendor/html/html_parser.php');
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    $series = str_replace(' ', '', $options['series']);

    $seriesUrl = 'http://epguides.com/'.$series.'/';
    
    $content = file_get_html($seriesUrl);

    $links = array();

    foreach ($content->find('div[id=eplist]') as $div)
    {
      foreach ($div->find('a') as $link)
      {
        if ($link->plaintext != 'Trailer' && $link->plaintext != '' && $link->plaintext != 'Recap')
        {
          $matches = array();
          $preg_string = preg_quote($link->outertext,"/");
          if (preg_match("/.{2}\/.{3}\/.{2}.{3}$preg_string/", $div->innertext, $matches))
          {
            $newLink = strip_tags($matches[0]);
            $newLinkParts = explode("   ",$newLink);
            $title = explode(" ",$link->title);
            $i = 0;
            foreach ($title as $titlePart) {
              if ($titlePart == 'episode') {
                $episode = $title[$i+1];
                $episodeCode = "e".$episode;
              }
              if ($titlePart == 'season') {
                $season = $title[$i+1];
                $seasonCode = "s".$season;
              } 
              $i++;
            }
            $code = $seasonCode.$episodeCode;
            $links[$code]['title'] = $newLinkParts[1];
            $parsedDate = date_parse_from_format("d/M/y", $newLinkParts[0]);
            $links[$code]['date'] = date("Y-m-d",strtotime($parsedDate['year']."-".$parsedDate['month']."-".$parsedDate['day']));
            $links[$code]['season'] = $season;
            $links[$code]['episode'] = $episode;
          }
        }
      }
    }

    $seriesTitle = '';
     foreach ($content->find('h1') as $header) {
       $seriesTitle = $header->plaintext;
     }

     foreach ($content->find('img[class=CasLogPic]') as $pic) {
       $picUrl = $seriesUrl.$pic->src;
     }
     

     
     
     $serie = Serie::getSerieByName($seriesTitle);
     file_put_contents(sfConfig::get('sf_web_dir')."/images/series/".$serie->id.".jpg",file_get_contents($picUrl));     
     
     $this->logSection('info', 'Inserting '.$seriesTitle, 256, 'INFO');
     
     
     foreach ($links as $link) {
       Episode::insertEpisode($serie,$link['season'],$link['episode'],$link['title'],$link['date']);
       $this->logSection('info', '         episode s'.$link['season'].'e'.$link['episode'].': '.$link['title'], 256, 'INFO');
       
     }
    
  }
}
