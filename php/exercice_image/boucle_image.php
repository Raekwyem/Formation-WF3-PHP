<style>
	h3 {background-color: red; color: #FFF; height: 50px;}
	* {font-family: Calibri, sans serif;}
</style>
<?php
// récupérer 5 images sur le web et les renommer de cette façon:
// image1.jpg
// image2.jpg
// image3.jpg
// image4.jpg
// image5.jpg
// 
// 1 - afficher une image avec une balise <img />
// 2 - afficher une image 5 fois toujours en écrivant 1 seule balise <img />
// 3 - afficher les 5 images différentes toujours en écrivant une seule balise <img />

echo '<h3>1 - afficher une image avec une balise img</h3>';
echo '<img src="image1.jpg" />';

echo '<h3>2 - afficher une image 5 fois avec une balise img</h3>';
for ($x = 0 ; $x <= 4 ; $x++ )
{
	echo '<img src="image2.jpg" width="300" />';
}

echo '<h3>3 - afficher les 5 images avec une balise img</h3>';
$a = 'src="image1.jpg"';
$b = 'src="image2.jpg"';

for ($x = 1 ; $x <= 5 ; $x++ )
{
	echo '<img src="image' . $x . '.jpg" width="300" />';
}