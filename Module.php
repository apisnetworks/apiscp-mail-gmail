<?php declare(strict_types=1);

	/**
	 * Copyright (C) Apis Networks, Inc - All Rights Reserved.
	 *
	 * MIT License
	 *
	 * Written by Matt Saladna <matt@apisnetworks.com>, August 2018
	 */

	namespace Opcenter\Mail\Providers\Gmail;

	use Module\Provider\Contracts\ProviderInterface;

	// stub to make apnscp happy
	class Module extends \Email_Module implements ProviderInterface
	{
		/**
		 * Get DNS records
		 *
		 * @param string $domain
		 * @param string $subdomain
		 * @return array
		 */
		public function get_records(string $domain, string $subdomain = ''): array
		{
			$ttl = $this->dns_get_default('ttl');

			return [
				new \Opcenter\Dns\Record($domain,
					['name' => $subdomain, 'ttl' => $ttl, 'rr' => 'MX', 'parameter' => '1 ASPMX.L.GOOGLE.COM.']),
				new \Opcenter\Dns\Record($domain,
					['name' => $subdomain, 'ttl' => $ttl, 'rr' => 'MX', 'parameter' => '5 ALT1.ASPMX.L.GOOGLE.COM.']),
				new \Opcenter\Dns\Record($domain,
					['name' => $subdomain, 'ttl' => $ttl, 'rr' => 'MX', 'parameter' => '5 ALT2.ASPMX.L.GOOGLE.COM.']),
				new \Opcenter\Dns\Record($domain,
					['name' => $subdomain, 'ttl' => $ttl, 'rr' => 'MX', 'parameter' => '10 ASPMX2.GOOGLEMAIL.COM.']),
				new \Opcenter\Dns\Record($domain,
					['name' => $subdomain, 'ttl' => $ttl, 'rr' => 'MX', 'parameter' => '10 ASPMX3.GOOGLEMAIL.COM.']),
				new \Opcenter\Dns\Record($domain,
					['name' => rtrim("mail.${subdomain}",'.'), 'ttl' => $ttl, 'rr' => 'CNAME', 'parameter' => 'ghs.google.com.']),
				new \Opcenter\Dns\Record($domain,
					['name'      => $subdomain,
					 'ttl'       => $ttl,
					 'rr'        => 'TXT',
					 'parameter' => '"v=spf1 include:_spf.google.com a ~all"'
					]),
			];
		}

	}