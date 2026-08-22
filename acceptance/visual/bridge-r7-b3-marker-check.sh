#!/usr/bin/env bash
# Focused regression for TASK-INTENT-4970DF201266F84F (Bridge R7 Acceptance B retry):
# the staging home page (front-page.php) must render the exact marker BRIDGE_R7_B3_OK
# as a semantically inert HTML comment, and must not contain "Fatal error".
#
# Usage:
#   acceptance/visual/bridge-r7-b3-marker-check.sh            # static template check
#   acceptance/visual/bridge-r7-b3-marker-check.sh --live URL # also check rendered HTML
set -euo pipefail

ROOT="$(cd "$(dirname "$0")/../.." && pwd)"
TEMPLATE="$ROOT/wordpress/wp-content/themes/neurocoaching/front-page.php"
MARKER='BRIDGE_R7_B3_OK'

if ! grep -qF -- "<!-- ${MARKER} -->" "$TEMPLATE"; then
	echo "FAIL: marker comment <!-- ${MARKER} --> not found in $TEMPLATE" >&2
	exit 1
fi
echo "PASS: marker comment present in front-page.php"

if [[ "${1:-}" == "--live" ]]; then
	URL="${2:?--live requires a URL}"
	HTML="$(curl -fsSL "$URL")"
	if ! grep -qF "$MARKER" <<<"$HTML"; then
		echo "FAIL: marker ${MARKER} not rendered at $URL" >&2
		exit 1
	fi
	if grep -qF "Fatal error" <<<"$HTML"; then
		echo "FAIL: 'Fatal error' present at $URL" >&2
		exit 1
	fi
	echo "PASS: marker rendered at $URL and no 'Fatal error'"
fi
