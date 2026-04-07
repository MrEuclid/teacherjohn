<?php
// google_json_helper.php

function getGoogleChartsJson(mysqli $db, string $query): string {
    $result = $db->query($query);

    if (!$result) {
        return json_encode(['error' => 'Query failed: ' . $db->error]);
    }

    $cols = [];
    $fields = $result->fetch_fields();
    $numericTypes = [3, 4, 5, 8, 16, 246];

    foreach ($fields as $field) {
        $isNumber = in_array($field->type, $numericTypes);
        $cols[] = [
            'id'      => '',
            'label'   => $field->name,
            'pattern' => '',
            'type'    => $isNumber ? 'number' : 'string'
        ];
    }

    $rows = [];
    while ($row = $result->fetch_row()) {
        $c = [];
        foreach ($row as $index => $value) {
            if ($value === null) {
                $v = null;
            } else {
                $v = ($cols[$index]['type'] === 'number') ? (float)$value : (string)$value;
            }
            $c[] = ['v' => $v];
        }
        $rows[] = ['c' => $c];
    }

    return json_encode(['cols' => $cols, 'rows' => $rows]);
}
?>
