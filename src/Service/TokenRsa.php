<?php

namespace App\Service;

class TokenRsa
{
    public static $privateKey = <<<EOD
-----BEGIN RSA PRIVATE KEY-----
MIICWwIBAAKBgQCOc/yiBxbfgfdknFF6wGF/If55TQgFjhya9h2WsRHdV+o4IbbN
Cei2WojmyvzUIJXwTv6vGT50KbCsERAG7q/XK88zFbkxuJl4da+pObQHlCMZV+2j
gZJH9V6rlwx6GcpLDbmp8D54wTRrsp7febsf8S7b5+pzblyv1ZTcqE2poQIDAQAB
AoGABXZbHJdrAB0KsHfyA+P2mRpjmKEkipn9bM+9KLcXeUZSu95HFSupGbz0/OyR
r0ykkzdkOrCcHXYvyRlKZQmoAmiIxJyD+t+1z6g7XAMJPYd/n3WUv50bNhT5iKEl
gGgUuSGNlZng1G9kuFZks1jxQj87geo1jNHDGA0b3EiefjECQQDIvp5nJc00xsFn
v2qe28c5au8jwyOQWFcfN/3ph0Yq0uGB6xP7+xPNTBNF+GfRtIAVsgBQgxm21bPI
VFkyIpkVAkEAtanhdpa29aTwGPBSU9DB26vx2UbMxGvWiPj6n1jVPJQRMkq/+r0z
A3paWTBtGSRZ7KB/U2ir/wyONwce3eUZXQJActpc1rcSCTgOP8WMwwcLnRZJbDSh
jFx+vCXU6F+1DZtJ2oMdE/Y7BiKYhFfzTk/vWHpXI7leZPUvv1ZDEiQpYQJAOZm/
74YiRQkjSAULVaAfl7ORX79fNfircYrgjJ3yHt8kBLpG3Q4YmsW02ArOzOYFzU2m
kZ/iyWAFx9TuKJV30QJAFHSPbXpt7QWeyfcyCzvDqqTuihKk6LFJiiIfmWyYfIqn
GBkgMnzcFrzhFds1YW96P1bDWNJbfrWkKrwteNWcFw==
-----END RSA PRIVATE KEY-----
EOD;

    public static $publickey = <<<EOD
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCOc/yiBxbfgfdknFF6wGF/If55
TQgFjhya9h2WsRHdV+o4IbbNCei2WojmyvzUIJXwTv6vGT50KbCsERAG7q/XK88z
FbkxuJl4da+pObQHlCMZV+2jgZJH9V6rlwx6GcpLDbmp8D54wTRrsp7febsf8S7b
5+pzblyv1ZTcqE2poQIDAQAB
-----END PUBLIC KEY-----
EOD;
}
