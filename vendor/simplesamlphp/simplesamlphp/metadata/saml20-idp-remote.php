<?php
/**
 * SAML 2.0 remote IdP metadata for SimpleSAMLphp.
 *
 * Remember to remove the IdPs you don't use from this file.
 *
 * See: https://simplesamlphp.org/docs/stable/simplesamlphp-reference-idp-remote
 */

$metadata['http://tyke.entries.keplerchallenge.co.nz/simplesaml/saml2/idp/metadata.php'] = array (
  'metadata-set' => 'saml20-idp-remote',
  'entityid' => 'http://tyke.entries.keplerchallenge.co.nz/simplesaml/saml2/idp/metadata.php',
  'SingleSignOnService' =>
  array (
    0 =>
    array (
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
      'Location' => 'http://tyke.entries.keplerchallenge.co.nz/simplesaml/saml2/idp/SSOService.php',
    ),
  ),
  'SingleLogoutService' =>
  array (
    0 =>
    array (
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
      'Location' => 'http://tyke.entries.keplerchallenge.co.nz/simplesaml/saml2/idp/SingleLogoutService.php',
    ),
  ),
  'certData' => 'MIIDrTCCApWgAwIBAgIJANTnH/yGoMQiMA0GCSqGSIb3DQEBCwUAMG0xCzAJBgNVBAYTAk5aMRAwDgYDVQQHDAdUZSBBbmF1MRcwFQYDVQQKDA5ub3J3ZWdpYW4uYmx1ZTEQMA4GA1UEAwwHVlBTMTE3MDEhMB8GCSqGSIb3DQEJARYScm9vQG5vcndlZ2lhbi5ibHVlMB4XDTE3MTIwODAxMTMyNVoXDTI3MTIwODAxMTMyNVowbTELMAkGA1UEBhMCTloxEDAOBgNVBAcMB1RlIEFuYXUxFzAVBgNVBAoMDm5vcndlZ2lhbi5ibHVlMRAwDgYDVQQDDAdWUFMxMTcwMSEwHwYJKoZIhvcNAQkBFhJyb29Abm9yd2VnaWFuLmJsdWUwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQC1UbbFOtICUG9bEVseoAU4aDyJLDI6Mtdjbeih4Hcll7OcEqk5vrpJuUuia1YUeRGlGh46a07HtZavQW2c08PFZKIBfPodijYyhM3cODcl+KRaJTG5a6RyANaEoeFioj2jRl7GwOtimpynQWcYxKT9MaK28uiayuL9fzmQ5gMx0tPgcn1h9zldbOKtMV86cC+tGZ9TAhcScq8hb6sd74nXxmneNr6rvBdMnE8iDGsqDTUU/U4SGOsBhevPF1rps02XuKL6K0YKbQ2FtcE+/hIw83izwA3DiHLFsCdCmKqk2bwSDd1VnCGtcObzLnqnj3h1YL18hoLraNeCDkD+abTdAgMBAAGjUDBOMB0GA1UdDgQWBBQE6CpK7FAddcIQ/PCOOzcZnvMXTjAfBgNVHSMEGDAWgBQE6CpK7FAddcIQ/PCOOzcZnvMXTjAMBgNVHRMEBTADAQH/MA0GCSqGSIb3DQEBCwUAA4IBAQAzBrNg30oeGqB2E9rmzftnXtRXi+djwYxdr6xLpjjS+hY/aLqOmW3j0RtquqzYuBllmUu9+ervR55h+sXW0BSA5WbKAOo2e1aRwi8Cg7u0eT2VLCfHcOPgsarPoToBXt4eDiiab7jVxdUmGuUF7+Qo76FhVzkkLp4/kS8Tpre/7ibsKSt8lMvrGxhol6rB9Pa2uQ++g1/R+3CrpuOS8ApENtteNRMLtgwi5FKsBpgGcuYDHdGqbVZwOdLRnS2ddsKca9/xPJniszSwkm+obQB5/le9kRLSmKC8WJzGOqT/R0fQVlJSTmxqe3AzcCqO1QNTv1x0fBsx7OAg0wi9zfHV',
  'NameIDFormat' => 'urn:oasis:names:tc:SAML:2.0:nameid-format:transient',
  'contacts' =>
  array (
    0 =>
    array (
      'emailAddress' => 'roo@norwegian.blue',
      'contactType' => 'technical',
      'givenName' => 'Administrator',
    ),
  ),
);
