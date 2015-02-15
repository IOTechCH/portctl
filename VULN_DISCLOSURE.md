## Vulnerability Full Disclosure

This page is dedicated to providing full disclosure of all reported and patched vulnerabilities.

## How to report vulnerabilities

Reporting vulnerabilities is quite simple, drop an email to portctl@hotmail.com and/or admin@iotech.ch. We will review the report, upon successful reproducing of the vulnerability we will apply a patch. 

## 2015-02-14

Reporter: Vlad C.

Reported via: EMAIL

Bug: Persistent XSS

Patched: Yes

Details: Customer's email was not checked for validity, nor sanitized.

https://github.com/IOTechCH/portctl/blob/69049bd29f5f429f8ec2621b8ed4e415f3a154ea/pricing.php#L218-L220

https://github.com/IOTechCH/portctl/blob/69049bd29f5f429f8ec2621b8ed4e415f3a154ea/admincp/pending.php#L414-L433

POC: Navigate to pricing.php?tag=50&pid=3, in the email field submit:

<script>console.log('xss');</script>x@x.com or similiar string, and the XSS will be executed on the admincp/pending.php page.