# lms
Loan management system

add to vendor\zelenin\yii2-semantic-ui\assets\SemanticUICSSAsset.php
public $depends = [
	'yii\bootstrap\BootstrapPluginAsset',
];


add FMAbhaya.ttf and FMAbhayaBold.ttf to vendor\mpdf\mpdf\ttfonts

add to vendor/mpdf/mpdf/src/Config/FontVariables.php
"fmabhaya" => [/* Cuneiform */
	'R' => "FMAbhaya.ttf",
	'B' => "FMAbhayaBold.ttf"
],