#!/usr/bin/env bash

set -euo pipefail

TIBALEINE_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"

php "$TIBALEINE_ROOT/tools/test-runner.php" "$@"
