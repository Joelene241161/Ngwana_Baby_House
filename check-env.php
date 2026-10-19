<?php
// List of expected environment variable keys
$keys = ['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS'];

echo "<h2>Azure Environment Variable Diagnostic</h2>";
echo "<table border='1' cellpadding='8' style='border-collapse: collapse;'>";
echo "<tr><th>Variable Name</th><th>Status</th><th>Value Length / Preview</th></tr>";

foreach ($keys as $key) {
    $value = getenv($key);
    if ($value !== false && $value !== '') {
        $preview = (strlen($value) > 4) ? substr($value, 0, 3) . '***' : '***';
        echo "<tr>";
        echo "<td><code>{$key}</code></td>";
        echo "<td style='color: green;'><strong>Loaded</strong></td>";
        echo "<td>Length: " . strlen($value) . " chars (Preview: {$preview})</td>";
        echo "</tr>";
    } else {
        echo "<tr>";
        echo "<td><code>{$key}</code></td>";
        echo "<td style='color: red;'><strong>Missing / Empty</strong></td>";
        echo "<td>Not detected by getenv()</td>";
        echo "</tr>";
    }
}
echo "</table>";

// Optional: Check all available environment variables
echo "<h3>All Available Environment Keys (Count: " . count($_SERVER) . ")</h3>";
echo "<p>PHP is running under SAPI: <strong>" . php_sapi_name() . "</strong></p>";
?>