// process_market_run.php

header('Content-Type: application/json');

// Get POST data (assuming JSON payload from fetch API)
$data = json_decode(file_get_contents('php://input'), true);

$price = floatval($data['price']);
$mangoes = intval($data['mangoes']);
$cups = intval($data['cups']);

// Run the simulation
$report_data = runMarketSimulation($price, $mangoes, $cups);

// Send the JSON response back to the frontend to build the report UI
echo json_encode($report_data);