<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Repository\ConfigurationRepository;
if(!file_exists("../../../.env")){

    $primaryColor = "#5740EE";
    $secondaryColor = "#9740EE";
}else {
    $configurationRepository = new ConfigurationRepository();
    $configuration = $configurationRepository->findById($configurationRepository->findOne());
    $primaryColor = $configuration->getColorPrimary();
    $secondaryColor = $configuration->getColorSecondary();

}

?>