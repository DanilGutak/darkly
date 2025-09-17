## File Upload Vulnerability (Image Format)

### Summary
A vulnerability was discovered in the file upload functionality, allowing attackers to upload files containing malicious code due to insufficient validation of file formats.

### Methodology
1. Attempted to upload a file with a `.php` extension disguised as an image by setting the MIME type to `image/jpeg`.
2. Used the following command to perform the upload:
	```
	curl -H 'Content-Type: multipart/form-data' -F 'Upload=send' -F 'uploaded=@lol.php;type=image/jpeg' "http://localhost:8080/index.php?page=upload" | grep flag
	```
3. The server accepted the file, enabling remote code execution via the uploaded PHP script.

### Findings
- The upload mechanism does not strictly enforce file type validation, allowing arbitrary files to be uploaded.
- This exposes the server to XSS and remote code execution attacks.

### Impact
- Attackers can execute arbitrary code on the server, potentially compromising sensitive data and system integrity.
- The vulnerability is difficult to prevent without robust file validation and sanitization.

### Recommendation
- Implement strict server-side validation of file types and extensions.
- Restrict executable file uploads and validate MIME types.
- Regularly audit upload functionality for security weaknesses.
