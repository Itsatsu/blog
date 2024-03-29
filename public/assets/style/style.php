<?php
require "../../../src/config.php";
header("Content-type: text/css");

?>
html{
margin: 0;
padding: 0;
}
body{
background-color: #1E1D2B;
}
a{
text-decoration: none;
color: <?= $secondaryColor ?> ;
font-size: 20px;
}
a:link{
color: <?= $secondaryColor?> ;
text-decoration: none;
}
p{
color: rgba(255, 255, 255, 0.5);
}
h1, h2{
font-family: Gilroy-Semibold;
font-weight: normal;
font-size: 30px;
color: #ffffff;
}
h3{
font-family: Gilroy-Semibold;
font-weight: normal;
font-size: 20px;
color: #404251;
}
@media (max-width: 900px) {
.container{
margin-left: 0 !important;
margin-right: 0!important;
width: 100% !important;
display: flex;
justify-content: center;
}
.perso{
display: none;
}
input[type="submit"]{
background: linear-gradient(90deg, <?= $primaryColor; ?> 0%, <?= $secondaryColor; ?> 100%);
height: 50px;
width: 200px !important;
}
nav{
background-color: #2B2C3E;
position: absolute;
bottom: 0 !important;
top: auto !important;
height: 50px !important;
width: 100% !important;
border-radius:36px 36px 0 0 !important;
}
nav span{
display: none;
}
.lien{
margin-top: 10px !important;
display: flex;
flex-direction: row !important;
justify-content: space-around;
margin: 0;
}
nav a{
color: #404251 !important;
}
nav .prenom{
display: none;
}
nav div{
text-align: center;
margin-top: 0px !important;
}
.contenu{
width: 100% !important;
left: 0 !important;
justify-content: center;
display: flex;
text-align: center;
}
}
html{
font-family: "Gilroy-Medium";
font-weight: normal;
}
input, button, select{
font-family: "Gilroy-Medium";
font-size: 20px;
border-radius: 100px;
background: #404251;
border: none;
padding-left: 15px;
color: white;
width: 80%;
height: 40px;
margin: 10px;
text-align: center;
}
textarea{
font-family: "Gilroy-Medium";
font-size: 20px;
border-radius: 36px;
background: #404251;
border: none;
padding-left: 15px;
color: white;
width: 80%;
height: 150px;
margin: 10px;
}
input[type="submit"], button{
background: linear-gradient(90deg, <?= $primaryColor; ?> 0, <?= $secondaryColor; ?> 100%);
height: 50px;
width: 60%;
cursor: pointer;
}
.container{
margin-left: 2%;
margin-right: 2%;
display: flex;
justify-content: center;
}
.contenu{
position: absolute;
width: 80%;
display: flex;
flex-direction: column;
justify-content: center;
}
.fond-gris{
background: #2B2C3E;
border-radius: 24px;
z-index: 2;
}
nav{
background-color: #2B2C3E;
position: fixed;
left: 0;
right: 0;
top: 0;
bottom: 0;
height: 100%;
width: 15%;
border-radius: 0 36px 36px 0 ;

}
nav div{
color: <?= $secondaryColor;  ?> ;
margin-top: 20px;
}
nav a{
color: <?= $secondaryColor; ?> ;
margin: 20px;
text-align: center;
}
nav span{
margin-left: 5px;
}
.prenom{
text-align: center;
}
.lien{
display: flex;
flex-direction: column;
justify-content: space-around;
align-items: center;
margin: 0;
}
.elipse1{
background: radial-gradient(81.25% 81.25% at 67.32% 18.75%, <?= $primaryColor; ?> 0, <?= $secondaryColor; ?> 100%) ;
border-radius: 50%;
box-shadow: 0 0 100px 10px rgba(34, 215, 226, 0.3);
transform: rotate(30deg);
position: fixed;
width: 190px;
height: 190px;
left: 10%;
top: -40px;
z-index: -1;
}
.elipse2{
background: radial-gradient(81.25% 81.25% at 67.32% 18.75%, <?= $primaryColor;?> 0, <?= $secondaryColor; ?> 100%);
border-radius: 100%;
box-shadow: 0 0 100px 10px rgba(34, 215, 226, 0.3);
transform: rotate(30deg);
position: fixed;
width: 220px;
height: 220px;
right: 15%;
top: 10%;
z-index: -1;
}
.elipse3{
background: radial-gradient(81.25% 81.25% at 67.32% 18.75%, <?= $primaryColor; ?> 0, <?= $secondaryColor; ?> 100%) ;
border-radius: 50%;
border-radius: 100%;
box-shadow: 0 0 100px 10px rgba(34, 215, 226, 0.3);
transform: rotate(30deg);
position: fixed;
width: 220px;
height: 220px;
right: 30%;
bottom: 5%;
z-index: -1;
}
.perso{
position: absolute;
bottom: 0;
width: 60%;
}
.alert-success{
color: green;
}
.alert-danger{
color: red;
}
@font-face {
font-family: "Gilroy-Medium";
font-style: normal;
src: url('../font/Gilroy-Medium.ttf');
}
@font-face {
font-family: "Gilroy-Semibold";
font-style: normal;
src: url('../font/Gilroy-SemiBold.ttf');
}
@font-face {
font-family: "Gilroy-Bold";
font-weight: bold;
src: url('../font/Gilroy-Bold.ttf');
}