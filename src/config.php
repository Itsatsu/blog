<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Core\Database;
use Repository\ConfigurationRepository;
$configurationRepository = new ConfigurationRepository();
$configuration = $configurationRepository->findById(1);
$primaryColor = $configuration->getColorPrimary();
$secondaryColor = $configuration->getColorSecondary();
?>