<?php
if (load_request()->is_get()) {
    // in("is_get");
    $content = load_request()->get_value('content');
    $email = load_request()->get_value('email');
    $author = load_request()->get_value('author');
    $related_url = load_request()->get_value('related_url');
    $related_id = load_request()->get_value('related_id');
    $website = load_request()->get_value('website');
    $parent_id = load_request()->get_value('parent_id');
}

if (load_request()->is_post()) {
    // in("is_post");
    $content = load_request()->post_value('content');
    $email = load_request()->post_value('email');
    $author = load_request()->post_value('author');
    $related_url = load_request()->post_value('related_url');
    $related_id = load_request()->post_value('related_id');
    $website = load_request()->post_value('website');
    $parent_id = load_request()->post_value('parent_id');
}

if ($content != null && $email != null && $author != null && $related_url != null && $related_id != null) {
    // get token Turnstile to form
    // $turnstile_response = load_request()->post_value('cf-turnstile-response');
    $turnstile_response = $_POST['cf-turnstile-response'];
    $secret_key = '0x4AAAAAAA_l7t-0IMuFbb9AFSoIZy8fq4g'; // your Secret Key
    $user_ip = $_SERVER['REMOTE_ADDR']; // get IP user
    // echo 111 . $turnstile_response;

    // fetch Cloudflare
    $url = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
    $data = [
        'secret' => $secret_key,
        'response' => $turnstile_response,
        'remoteip' => $user_ip // Optional, helps increase accuracy
    ];

    // Send POST request
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // bypass Cloudflare
    $result = json_decode($response, true);

    if ($result && $result['success'] === true) {
        // Valid token, process form
        // $name = htmlspecialchars($_POST['name']);
        // echo "Valid!<br>";

        $parent_id = ($parent_id != null && (int)$parent_id > 0) ? (int)$parent_id : 0;
        $result = \helper\comment::comment_save($related_url, $related_id, $content, $author, $email, $parent_id, $website);
        echo json_encode($result);
    } else {
        // inValid Token 
        echo "inValid. bot!";
        if (isset($result['error-codes'])) {
            echo "<br>error: " . implode(", ", $result['error-codes']);
        }
    }
} else {
    echo 'null!';
}
