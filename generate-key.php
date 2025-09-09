<?php

// Generate Laravel APP_KEY manually
$key = 'base64:' . base64_encode(random_bytes(32));

echo "Your Laravel APP_KEY is: <br><br><strong>$key</strong>";
