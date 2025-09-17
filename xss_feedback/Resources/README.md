## XSS Vulnerability

### Summary
A cross-site scripting (XSS) vulnerability was discovered in one of website forms. The issue stems from improper input sanitization: one field is only validated on the client side, while another is validated on the server side.

### Details
- During testing, we injected the following payload into the vulnerable field:
	```html
	<ScripT>alert("XSS")</ScripT>
	```
- The payload was accepted and stored on the server. As a result, the malicious code executes in the browser of any user who visits the affected page.

### Impact
- Attackers can leverage this vulnerability to steal user cookies and sensitive data.
- The injected alert can easily be replaced with a `fetch` request to exfiltrate user information to a remote server.

### Recommendation
- Implement robust server-side input validation and sanitization for all form fields.
- Review and update client-side validation to ensure consistency with server-side checks.
