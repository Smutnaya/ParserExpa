<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
</head>

<body>
    <?php

    require "vendor/autoload.php";

    use PHPHtmlParser\Dom;
    use PHPHtmlParser\Options;

    $dom = new Dom;
    //$dom->loadFromUrl('http://www.alrage.ru/exp.php');
    $dom->loadFromFile('table.html');
    $contents = $dom->find('.aTable');

    $trList = $contents->find('tr');

    $table = [];
    $result6;
    $id = 0;

    foreach($trList as $tr)
    {
        $t = [];

        $tdList = $tr->find('td');
        $thList = $tr->find('th');

        $thCount = count($thList);         
        if($thCount == 1)
        {
            //echo '<br>'.$thList->innerHtml;
            $thList->firstChild();
            $str = $thList->firstChild();

            $result6 = preg_replace('#[\[Уровень\]]#', '', $str);
        }
        else
        if($thCount == 0)
        {
            //echo '<br>'.$tdList[1]->innerHtml;
            $str = $tdList[1]->innerHtml;
            $result = preg_replace('#[^\d]#', '', $str);
            $str1 = $tdList[0]->innerHtml;
            $result1 = preg_replace('#[^\d]#', '', $str1);
            $str2 = $tdList[3]->innerHtml;
            $result2 = preg_replace('#[^\d]#', '', $str2);
            $str3 = $tdList[6]->innerHtml;
            $result3 = preg_replace('#[^\d]#', '', $str3);
            $str4 = $tdList[5]->innerHtml;
            $result4 = preg_replace('#[^\d]#', '', $str4);
            $str5 = $tdList[4]->innerHtml;
            $result5 = preg_replace('#[^\d]#', '', $str5);

            //echo '<br>' . 'ap '. $result1.' exp '. $result . ' stat ' . $result2 . ' stamina ' . $result3 . ' dt ' . $result4 . ' weapon ' . $result5 ;

            //array_push($t,['exp' =>  $result], [ 'up' =>  $result1], ['stats' => $result2], ['stamina' => $result3], ['dt' => $result4],['we apon' => $result5]);
            if($result1 == 0)
            {
                $t = [
                    'id' => $id,
                    'level' => $result6,
                    'up' =>$result1,
                    'exp' => $result,
                    'stats' => $result2,
                    'race' => 1,
                    'stamina' => $result3, 
                    'md' => $result4,
                    'weapon' => $result5
                ];
            } else{
                $t = [
                    'id' => $id,
                    'level' => $result6,
                    'up' => $result1,
                    'exp' => $result,
                    'stats' => $result2,
                    'race' => 0,
                    'stamina' => $result3,
                    'md' => $result4,
                    'weapon' => $result5
                ];
            }

        }

        //var_dump($table);


        // if(count($thList) > 0)
        // {
        //     print_r($thList);
        // }

        if ($t)
        {
            $table[] = $t;
            $id++;
        }
        //array_push($table, $t);
    }

    echo '<pre>';
    //print_r($t);

        for ($i = 19; $i < count($table); $i++)
        {
            echo '[\'id\' => ' . $table[$i]['id'] . ',\'level\' => ' . $table[$i]['level'] . ',\'up\' => ' . $table[$i]['up'] .',\'exp\' => ' . $table[$i]['exp'] . ',\'stats\' => ' . $table[$i]['stats'] . ',\'race\' => ' . $table[$i]['race'] . ',\'stamina\' => ' . $table[$i]['stamina'] . ',\'md\' => ' . $table[$i]['md'] . ',\'weapon\' => ' . $table[$i]['weapon'] . '], <br>';
        } 




    echo '<pre>';
    //print_r($table);
    //echo $contents;
    //$html = $dom->outerHtml;
    //$a = $dom->find('.aTable')[1];

    //var_dump($a);

    //echo $a;



    ?>
</body>

</html>