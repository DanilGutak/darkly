## Unvalidated Redirection Vulnerability

### Summary
A vulnerability was discovered in the website's redirection mechanism, which allows users to redirect to arbitrary external sources without proper validation. This can be exploited for phishing, open redirect attacks, and information disclosure.

### Methodology
1. Inspected the website footer and identified redirection links:
    ```html
    <a href="index.php?page=redirect&site=twitter" class="icon fa-twitter"></a>
    ```
2. Modified the `site` parameter to a custom value (e.g., `google`):
    ```bash
    curl http://localhost:8080/index.php?page=redirect&site=google
    ```
3. The server processed the request and provided the next link or flag, confirming the vulnerability.

### Findings
- The application does not validate or restrict the `site` parameter, allowing redirection to arbitrary external URLs.
- This exposes users to open redirect attacks, phishing risks, and potential leakage of sensitive information.

### Recommendation
- Implement strict validation and whitelisting of allowed redirection targets.
- Avoid using user-supplied input directly in redirection logic.
- Educate users about the risks of following untrusted links.