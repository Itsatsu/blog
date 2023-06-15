<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Repository\ConfigurationRepository;
if(!file_exists("../../../.env")){

    $primaryColor = "#d1f8b3";
    $secondaryColor = "#b3f8ff";
}else {
    $configurationRepository = new ConfigurationRepository();
    $configuration = $configurationRepository->findById(1);
    $primaryColor = $configuration->getColorPrimary();
    $secondaryColor = $configuration->getColorSecondary();

}

?>