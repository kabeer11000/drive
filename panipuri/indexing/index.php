<?php
$index = './static/index.json';
// Check if the request is sent through POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the JSON input sent through POST
    $json_input = file_get_contents('php://input');

    // Decode the JSON input into a PHP associative array
    $data = json_decode($json_input, true);

    // Check if the JSON input is valid
    if (json_last_error() === JSON_ERROR_NONE) {

        // Check if the index.json file exists
        if (!file_exists($index)) {

            // Create the index.json file if it doesn't exist
            file_put_contents($index, '[]');

        }

        // Read the existing data from the index.json file
        $existing_data = json_decode(file_get_contents($index), true);

        // Append the new data to the existing data
        $combined_data = array_push($existing_data, $data);

    // Write the combined data to the index.json file
    file_put_contents($index, json_encode($combined_data));

    // Return a success response
    http_response_code(200);
    echo json_encode(array('message' => 'Data appended successfully to index.json.'));

  } else {

        // Return an error response if the JSON input is invalid
        http_response_code(400);
        echo json_encode(array('message' => 'Invalid JSON input.'));

    }

} else {

    // Return an error response if the request is not sent through POST method
    http_response_code(405);
    echo json_encode(array('message' => 'Method not allowed.'));

}

?>
