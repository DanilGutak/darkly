## Laboratory Report: Unvalidated Vote Input Vulnerability

### Summary
A vulnerability was discovered in the voting form, which allows users to submit values outside the intended range due to lack of server-side validation.

### Methodology
1. The form presents a dropdown with options (values 1-10) for voting.
2. Assumed the server does not validate the input value beyond the dropdown selection.
3. Crafted a request with a numeric overflow using curl:
   ```bash
   curl 'http://localhost:8080/index.php?page=survey' \
     -H 'Content-Type: application/x-www-form-urlencoded' \
     --data-raw 'sujet=3&valeur=424242424242424242' | grep flag
   ```
4. The server accepted the out-of-range value and responded with the next flag.

### Findings
- The application relies solely on client-side validation, allowing malicious users to bypass restrictions.
- Numeric overflow or unexpected values can be submitted, leading to unintended behavior and information disclosure.

### Recommendation
- Implement robust server-side validation for all form inputs.
- Ensure that only expected values are processed, regardless of client-side controls.
