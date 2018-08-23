<?php

$str="ţŢŞşCheloți Germania ÎîÂâĂășȘȚț România este un stat situat în sud-estul Europei Centrale,
Iugoslavia 
";

//$str=file_get_contents('https://ro.wikipedia.org/wiki/Nistru');// /wiki/Iugoslavia
$str=file_get_contents('https://ro.wikipedia.org'.$_GET['page']);
/*$str='<!DOCTYPE html>
<script async="" src="/w/load.php?debug=false&amp;lang=ro&amp;modules=startup&amp;only=scripts&amp;skin=vector"></script>
<link rel="stylesheet" href="/w/load.php?debug=false&amp;lang=ro&amp;modules=site.styles&amp;only=styles&amp;skin=vector"/>
<div id="siteNotice" class="mw-body-content"><!-- CentralNotice --></div>';
*/



//echo ord($str[0])," ",ord($str[1])," "; //"\u021B"
function iftag( $tag, $konec )
{
  global $i, $str;  //echo strlen($tag);
  for( $k = 0; $k < strlen($tag); $k++){//echo $tag[ $k ],$str[ $i + $k ];
    if( $tag[ $k ] != $str[ $i + $k ] )return;}
    
  $pos = strpos( $str, $konec, $i + strlen($tag) );//echo $pos," ";
  $seredina = substr( $str, $i + strlen($tag), $pos-$i - strlen($tag) );//echo strlen($tag)," ",strlen($seredina)," ",strlen($konec); //echo " ",$i,$tag;
  
  $i = $i + strlen($tag) + strlen($seredina) + strlen($konec)-1;
  if( $tag == "<link" ) $seredina = str_replace( 'rel="stylesheet" href="', 'rel="stylesheet" href="https://ro.wikipedia.org', $seredina );
  if( $tag == "<script" ) $seredina = str_replace( ' async="" src="', ' async="" src="https://ro.wikipedia.org', $seredina );
  if( $tag == "<a" and strpos( $seredina, "cite_note" ) == false ) $seredina = str_replace( ' href="', ' href="/wikimoldia/trans.php?page=', $seredina );
  echo $tag, $seredina, $konec;
  
  return;
}




function ifword( $word, $perevod )
{
  global $i, $str; 
  for( $k = 0; $k < strlen($word); $k++){
    if( $word[ $k ] != $str[ $i + $k ] )return false;}
    
  $i = $i + strlen($word)-1;
  echo $perevod;
  
  return true;
}

function ifnebukva( $l )
{
  global $str;
  return $str[$l] == " " or $str[$l] ==  "." or $str[$l] == "!" or $str[$l] == "?" or $str[$l] == "," or $str[$l] == "(" or $str[$l] == ")" or $str[$l] == "<" or $str[$l] == ">" or
      $str[$l] == "'" or $str[$l] == '"' or $str[$l] == "-" or $str[$l] == "\n" or $str[$l] == ":" or $str[$l] == ";";
}


$mm=strlen($str);
for ($i=0;$i<=$mm;$i++)
{
  $ss=$str[$i];

  /*if( $str[$i-1] == " " or $str[$i-1] ==  "." or $str[$i-1] == "!" or $str[$i-1] == "?" or $str[$i-1] == "," or $str[$i-1] == "(" or $str[$i-1] == ")" or $str[$i-1] == "<" or $str[$i-1] == ">" or
      $str[$i-1] == "'" or $str[$i-1] == '"' or $str[$i-1] == "-" or $str[$i-1] == "\n" )
      ifword("Iugoslavia","Югославия");*/
      
  switch ($ss) 
  {

case "<":iftag("<!DOCTYPE html",">");iftag("<html",">");iftag("</html",">");iftag("<head",">");iftag("</head",">");iftag("<meta",">");iftag("<title>","</title>");iftag("<script","</script>");iftag("<link",">");
         iftag("<body",">");iftag("<div",">");iftag("</div",">");iftag("<a",">");iftag("</a",">");iftag("<img",">");iftag("<h1",">");iftag("</h1",">");iftag("<i",">");iftag("</i",">");
	 iftag("<table",">");iftag("</table",">");iftag("<tbody",">");iftag("</tbody",">");iftag("<tr",">");iftag("</tr",">");iftag("<td",">");iftag("</td",">");iftag("<small",">");iftag("</small",">");
	 iftag("<b",">");iftag("</b",">");iftag("<audio",">");iftag("</audio",">");iftag("<track",">");iftag("<source",">");iftag("<th",">");iftag("</th",">");iftag("<sup",">");iftag("</sup",">");
	 iftag("<br",">");iftag("<time",">");iftag("</time",">");iftag("<p",">");iftag("</p",">");iftag("<input",">");iftag("<h2",">");iftag("</h2",">");iftag("<span",">");iftag("</span",">");
	 iftag("<label",">");iftag("</label",">");iftag("<ul",">");iftag("</ul",">");iftag("<li",">");iftag("</li",">");iftag("<h3",">");iftag("</h3",">");iftag("<h4",">");iftag("</h4",">");
	 iftag("<!--","-->");iftag("<form",">"); iftag("</form",">");iftag("<ol",">"); iftag("</ol",">");iftag("<cite",">"); iftag("</cite",">");iftag("<noscript",">"); iftag("</noscript",">");
	 iftag("<h5",">");iftag("</h5",">");iftag("<h6",">");iftag("</h6",">");iftag("<dt",">");iftag("</dt",">");iftag("<dl",">");iftag("</dl",">");iftag("<dd",">");iftag("</dd",">");
	 iftag("<font",">");iftag("</font",">");
        break;
   
case "s":
        echo "с";
        break;

 case "c":
       
      {

       if ($str[$i+1]=="e" or $str[$i+1]=="i" or $str[$i+1]=="E" or $str[$i+1]=="I") {
       echo "ч";  
       break;}
       
       if (($str[$i+1]=="h" or $str[$i+1]=="H") and ($str[$i+2]=="e" or $str[$i+2]=="i" or $str[$i+2]=="E" or $str[$i+2]=="I") ) {
       $i=$i+1; echo "к";  
       break;}
 
       echo "к";
       break;

      }


case "j":
        echo "ж";
        break;

case "z":
       echo "з";
       break;

case "S":
      echo "С";
      break;

 case "C":
        
      {

       if ($str[$i+1]=="e" or $str[$i+1]=="i" or $str[$i+1]=="E" or $str[$i+1]=="I") {
       echo "Ч";  
       break;}
       
       if (($str[$i+1]=="h" or $str[$i+1]=="H") and ($str[$i+2]=="e" or $str[$i+2]=="i" or $str[$i+2]=="E" or $str[$i+2]=="I") ) {
       $i=$i+1; echo "К";  
       break;}
 
       echo "К";
       break;

      }


case "J": 
        echo "Ж";
        break;

case "Z":
        echo "З";
        break;

case "a":
      {

       if ( ($str[$i-1]=="i" or $str[$i-1]=="I") and ifnebukva($i+1) ) {
       echo "я";  
       break;}

        echo "а";
        break;
       }
case "b":
        echo "б";
        break;

case "d":
        echo "д";
        break;
 
case "e": if( ifword("exist","екзист") )break;
        echo "е";
        break;

case "f":
        echo "ф";
        break;

case "g":
      {

       if ($str[$i+1]=="e" or $str[$i+1]=="i" or $str[$i+1]=="E" or $str[$i+1]=="I") {
       echo "ӂ";  
       break;}
       
       if (($str[$i+1]=="h" or $str[$i+1]=="H") and ($str[$i+2]=="e" or $str[$i+2]=="i" or $str[$i+2]=="E" or $str[$i+2]=="I") ) {
       $i=$i+1; echo "г";  
       break;}
 
       echo "г";
       break;

      }

case "h":
        echo "х";
        break;

case "i":
       { if( ifword("iugoslav","югослав") )break;if( ifword("iulie","юлие") )break; if( ifword("iunie","юние") )break;
       
        if (($str[$i-1]=="i" or $str[$i-1]=="I" or $str[$i-1]=="u" or $str[$i-1]=="U" or $str[$i-1]=="e" or $str[$i-1]=="E" or $str[$i-1]=="a" or $str[$i-1]=="A" or $str[$i-1]=="o" or $str[$i-1]=="O") and 
	ifnebukva($i+1)) {
       echo "й";  
       break;}
       
       /*if (($str[$i+1]=="a" or $str[$i+1]=="A") and ($str[$i+2]=="r" or $str[$i+2]=="R") ) {
       echo "й";  
       break;}*/ if( ifword("iar","яр") )break;
       
       /*if ($str[$i+1]=="u" or $str[$i+1]=="U")  {
       $i=$i+1; echo "ю";  
       break;}*/
       
       if (($str[$i-1]=="z" or $str[$i-1]=="Z" or $str[$i-1]=="n" or $str[$i-1]=="N" or $str[$i-1]=="r" or $str[$i-1]=="R" or $str[$i-1]=="t" or $str[$i-1]=="T" or 
          $str[$i-1]=="l" or $str[$i-1]=="L" or $str[$i-1]=="g" or $str[$i-1]=="G" or $str[$i-1]=="m" or $str[$i-1]=="M" or $str[$i-1]=="b" or $str[$i-1]=="B" or $str[$i-1]=="v" or $str[$i-1]=="V" or
	  $str[$i-1]=="f" or $str[$i-1]=="F" or
         ($str[$i-2]==chr(200) and $str[$i-1]==chr(155) ) or ($str[$i-2]==chr(200) and $str[$i-1]==chr(154) )
	  or ($str[$i-2]==chr(200) and $str[$i-1]==chr(152) ) or ($str[$i-2]==chr(200) and $str[$i-1]==chr(153) )//ши превращается в шь
	 ) and 
	ifnebukva($i+1)) {
       echo "ь";  
       break;}
       
       if (($str[$i-1]=="c" or $str[$i-1]=="C" ) and 
	ifnebukva($i+1)) {
       //echo "ь";  
       break;}
       
        echo "и";
        break;
	}

case "k":
        echo "к";
        break;

case "l":
        echo "л";
        break;

case "m":
        echo "м";
        break;

case "n": if( ifword("noiembrie","ноембрие") )break;
        echo "н";
        break;

case "o":
        echo "о";
        break;

case "p":
        echo "п";
        break;

case "q":
        echo "к";
        break;

case "r": if( ifword("războiul","рэзбоюл") )break;
        echo "р";
        break;

case "t":
        echo "т";
        break;
	
case chr(200)://"ț"021B
	if ($str[$i+1]==chr(155)  ) {
       echo "ц";  
       $i=$i+1; break;}

	if ($str[$i+1]==chr(154)  ) {
       echo "Ц";  
       $i=$i+1; break;}
       
       if ($str[$i+1]==chr(153)  ) {
       echo "ш";  
       if(ifnebukva($i-1)and
       ($str[$i+2]=="i" or $str[$i+2]=="I")){echo "и";$i=$i+2; break;};  //ши
       $i=$i+1;break;}
       
       if ($str[$i+1]==chr(152)  ) {
       echo "Ш";  
       $i=$i+1; break;}
       
case chr(197)://"ŞşţŢ" с седилью
	if ($str[$i+1]==chr(159)  ) {
       echo "ш";  
       $i=$i+1; break;}

       if ($str[$i+1]==chr(158)  ) {
       echo "Ш";  
       $i=$i+1; break;}
       
       	if ($str[$i+1]==chr(163)  ) {
       echo "ц";  
       $i=$i+1; break;}

       if ($str[$i+1]==chr(162)  ) {
       echo "Ц";  
       $i=$i+1; break;}

case chr(196)://"ț"021B
	if ($str[$i+1]==chr(131)  ) {
       echo "э";  
       $i=$i+1; break;}

	if ($str[$i+1]==chr(130)  ) {
       echo "Э";  
       $i=$i+1; break;}
       
case chr(195)://"ț"021B
	if ($str[$i+1]==chr(162)  ) {
       echo "ы";  
       $i=$i+1; break;}

	if ($str[$i+1]==chr(130)  ) {
       echo "Ы";  
       $i=$i+1; break;}
       
       if ($str[$i+1]==chr(174)  ) {
       echo "ы";  
       $i=$i+1; break;}

	if ($str[$i+1]==chr(142)  ) {
       echo "Ы";  
       $i=$i+1; break;}
	
case "u":
        echo "у";
        break;

case "v":
        echo "в";
        break;

case "w":
        echo "в";
        break;

case "x":
      echo "кс";
        break;

case "y":
      echo "и";
        break;

case "A":
      {
       if (($str[$i-1]=="i" or $str[$i-1]=="I") and ifnebukva($i+1)) {
       echo "Я";  
       break;}
       
      echo "А";
        break;
      }
case "B":
      echo "Б";
        break;

case "D":
      echo "Д";
        break;

case "E": if( ifword("Exist","Екзист") )break;
      echo "Е";
        break;

case "F":
      echo "Ф";
        break;

case "G":
      {

       if ($str[$i+1]=="e" or $str[$i+1]=="i" or $str[$i+1]=="E" or $str[$i+1]=="I") {
       echo "Ӂ";  
       break;}
       
       if (($str[$i+1]=="h" or $str[$i+1]=="H") and ($str[$i+2]=="e" or $str[$i+2]=="i" or $str[$i+2]=="E" or $str[$i+2]=="I") ) {
       $i=$i+1; echo "Г";  
       break;}
 
       echo "Г";
       break;

      }

case "H":
      echo "Х";
        break;

case "I":
       { if( ifword("IV","IV") )break; if( ifword("III","III") )break; if( ifword("II","II") )break; if( ifword("I-","I-") )break; if( ifword("IX","IX") )break;
         if( ifword("Iugoslav","Югослав") )break; if( ifword("Iulie","Юлие") )break; if( ifword("Iunie","Юние") )break;
       
        if (($str[$i-1]=="i" or $str[$i-1]=="I" or $str[$i-1]=="u" or $str[$i-1]=="U" or $str[$i-1]=="e" or $str[$i-1]=="E" or $str[$i-1]=="a" or $str[$i-1]=="A" or $str[$i-1]=="o" or $str[$i-1]=="O") and 
	ifnebukva($i+1)) {
       echo "Й";  
       break;}
       
       /*if ($str[$i+1]=="u" or $str[$i+1]=="U")  {
       $i=$i+1; echo "Ю";  
       break;}*/
       
       if (($str[$i-1]=="c" or $str[$i-1]=="C" or $str[$i-1]=="z" or $str[$i-1]=="Z" or $str[$i-1]=="n" or $str[$i-1]=="N" or $str[$i-1]=="r" or $str[$i-1]=="R" or $str[$i-1]=="t" or $str[$i-1]=="T" or 
          $str[$i-1]=="l" or $str[$i-1]=="L" or $str[$i-1]=="g" or $str[$i-1]=="G" or $str[$i-1]=="m" or $str[$i-1]=="M" or $str[$i-1]=="b" or $str[$i-1]=="B" or $str[$i-1]=="f" or $str[$i-1]=="F" or
         ($str[$i-2]==chr(200) and $str[$i-1]==chr(155) ) or ($str[$i-2]==chr(200) and $str[$i-1]==chr(154) ) 
	 or ($str[$i-2]==chr(200) and $str[$i-1]==chr(152) ) or ($str[$i-2]==chr(200) and $str[$i-1]==chr(153) )
	 ) and 
	ifnebukva($i+1)) {
       echo "Ь";  
       break;}
       
      echo "И";
        break;
      }
case "K":
      echo "К";
        break;

case "L":
      echo "Л";
        break;

case "M":
      echo "М";
        break;

case "N": if( ifword("Noiembrie","Ноембрие") )break;
      echo "Н";
        break;

case "O":
      echo "О";
        break;

case "P":
      echo "П";
        break;
 
case "Q":
      echo "К";
        break;
  
case "R": if( ifword("Războiul","Рэзбоюл") )break;
      echo "Р";
        break;
 
case "T":
      echo "Т";
        break;
 
 case "U":
      echo "У";
        break;

case "V": if( ifword("VIII","VIII") )break; if( ifword("VII","VII") )break; if( ifword("VI","VI") )break; if( ifword("V-","V-") )break;
	  
      echo "В";
        break;
 
case "W":
      echo "В";
        break;

case "X": if( ifword("XXI","XXI") )break; if( ifword("XX","XX") )break; if( ifword("XIX","XIX") )break; if( ifword("XVIII","XVIII") )break; if( ifword("XVII","XVII") )break; if( ifword("XVI","XVI") )break;
          if( ifword("XV","XV") )break; if( ifword("XIV","XIV") )break; if( ifword("XIII","XIII") )break; if( ifword("XII","XII") )break; if( ifword("XI","XI") )break;
	  if( ifword("X-","X-") )break;
      echo "КС";
        break;

case "Y":
      echo "И";
        break;
 
default:
        echo $ss;
             
  }

}


	
/*echo "</b><br><br>";
echo "</blockquote>";

echo "<P><center>Спасибо за использование
сервиса !</center></p>";

echo "</body> ";  
echo "</html> "; */ 


