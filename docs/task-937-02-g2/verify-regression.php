<?php
/** Machine guard for the TASK-937-02 G2 Neurocoaching mobile visual correction. */
declare(strict_types=1);

$root     = dirname(__DIR__, 2);
$css      = file_get_contents($root . '/wordpress/wp-content/themes/neurocoaching/style.css');
$template = file_get_contents($root . '/wordpress/wp-content/themes/neurocoaching/page-neurocoaching.php');
$baseline = $root . '/acceptance/visual/neurocoaching-mobile-390x844.png';

$checks = array(
	'frozen baseline is unchanged' => hash_file('sha256', $baseline) === 'ca5e075479b1847bc82cd291abf8c419a3871cec2b4666912bf89bd950c93620',
	'exact acceptance heading remains semantic HTML' => str_contains($template, 'Burned out, overwhelmed, or know something needs to change?'),
	'forbidden error text is absent' => ! str_contains($template, 'Internal Server Error'),
	'mobile header interpolates from PSD to 390 baseline' => str_contains($css, 'height:clamp(53px,calc(21px + 10vw),60px);'),
	'mobile photo interpolates from PSD to 390 baseline' => str_contains($css, 'height:clamp(406px,calc(204.857px + 62.857vw),450px);'),
	'mobile hero retains space for the corrected composition' => str_contains($css, 'height:clamp(1029px,calc(951.286px + 24.286vw),1046px);'),
	'mobile hero preserves natural image proportions' => str_contains($css, 'height:100%; object-fit:cover; object-position:center 18%;'),
	'mobile navigation follows the corrected header' => str_contains($css, '.neurocoaching-route .primary-nav { position:absolute; top:100%;'),
	'mobile overflow remains bounded' => str_contains($css, '.home,.career-services-route,.neurocoaching-route { overflow-x:hidden;'),
);

$failed = array_keys(array_filter($checks, static fn(bool $passed): bool => !$passed));
if ($failed) {
	fwrite(STDERR, implode(PHP_EOL, $failed) . PHP_EOL);
	exit(1);
}

echo "PASS: TASK-937-02 G2 Neurocoaching mobile visual regression checks\n";
