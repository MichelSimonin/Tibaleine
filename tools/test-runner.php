<?php

declare(strict_types=1);

namespace PHPUnit\Framework {
    final class AssertionFailedError extends \RuntimeException
    {
    }

    abstract class TestCase
    {
        private ?string $expectedException = null;

        final public function expectException(string $exception): void
        {
            $this->expectedException = $exception;
        }

        final public function expectedException(): ?string
        {
            return $this->expectedException;
        }

        final public function fail(string $message = 'Le test a explicitement échoué.'): never
        {
            throw new AssertionFailedError($message);
        }

        final public function assertSame(mixed $expected, mixed $actual, string $message = ''): void
        {
            if ($expected !== $actual) {
                $this->fail($message !== '' ? $message : sprintf(
                    'Attendu %s, obtenu %s.',
                    var_export($expected, true),
                    var_export($actual, true),
                ));
            }
        }

        final public function assertNotSame(mixed $expected, mixed $actual, string $message = ''): void
        {
            if ($expected === $actual) {
                $this->fail($message !== '' ? $message : 'Les deux valeurs ne devaient pas être identiques.');
            }
        }

        final public function assertTrue(mixed $actual, string $message = ''): void
        {
            $this->assertSame(true, $actual, $message);
        }

        final public function assertFalse(mixed $actual, string $message = ''): void
        {
            $this->assertSame(false, $actual, $message);
        }

        final public function assertNull(mixed $actual, string $message = ''): void
        {
            $this->assertSame(null, $actual, $message);
        }

        final public function assertNotNull(mixed $actual, string $message = ''): void
        {
            if ($actual === null) {
                $this->fail($message !== '' ? $message : 'La valeur ne devait pas être nulle.');
            }
        }

        final public function assertCount(int $expected, mixed $actual, string $message = ''): void
        {
            $count = count($actual);
            $this->assertSame($expected, $count, $message !== '' ? $message : "Nombre attendu : {$expected}, obtenu : {$count}.");
        }

        final public function assertContains(mixed $needle, iterable $haystack, string $message = ''): void
        {
            $values = is_array($haystack) ? $haystack : iterator_to_array($haystack);
            if (!in_array($needle, $values, true)) {
                $this->fail($message !== '' ? $message : sprintf('%s est absent de la collection.', var_export($needle, true)));
            }
        }

        final public function assertStringContainsString(string $needle, string $haystack, string $message = ''): void
        {
            if (!str_contains($haystack, $needle)) {
                $this->fail($message !== '' ? $message : "La chaîne ne contient pas « {$needle} ».");
            }
        }

        final public function assertIsArray(mixed $actual, string $message = ''): void
        {
            if (!is_array($actual)) {
                $this->fail($message !== '' ? $message : 'La valeur attendue devait être un tableau.');
            }
        }
    }
}

namespace {
    use PHPUnit\Framework\AssertionFailedError;
    use PHPUnit\Framework\TestCase;

    $projectRoot = dirname(__DIR__);
    $filter = null;
    $generateReport = true;
    foreach (array_slice($argv, 1) as $argument) {
        if (str_starts_with($argument, '--filter=')) {
            $filter = substr($argument, 9);
        }
        if ($argument === '--no-report') {
            $generateReport = false;
        }
    }

    require $projectRoot . '/vendor/autoload.php';
    foreach (glob($projectRoot . '/tests/phpunit/*Test.php') ?: [] as $testFile) {
        require_once $testFile;
    }

    $testClasses = array_values(array_filter(
        get_declared_classes(),
        static fn (string $class): bool => is_subclass_of($class, TestCase::class),
    ));
    sort($testClasses);

    $green = "\033[32m";
    $red = "\033[31m";
    $cyan = "\033[36m";
    $bold = "\033[1m";
    $reset = "\033[0m";
    $passed = 0;
    $failed = 0;
    $groups = [];
    $executedMethods = [];
    $methodOwners = [];
    $testResults = [];
    $startedAt = microtime(true);

    echo "{$bold}{$cyan}Suite Tibaleine — vérification de tous les CASE{$reset}\n\n";

    foreach ($testClasses as $testClass) {
        foreach (get_class_methods($testClass) as $method) {
            if (!str_starts_with($method, 'test_')) {
                continue;
            }

            $identifier = $testClass . '::' . $method;
            if ($filter !== null && stripos($identifier, $filter) === false) {
                continue;
            }

            preg_match('/^test_CASE_((?:[A-Z]+_)*[A-Z]+)_\d+/', $method, $matches);
            $group = str_replace('_', '-', $matches[1] ?? 'AUTRE');
            $groups[$group] ??= ['passed' => 0, 'failed' => 0];
            $executedMethods[$method] = ($executedMethods[$method] ?? 0) + 1;
            $methodOwners[$method][] = $testClass;
            $test = new $testClass();

            try {
                $test->{$method}();
                if ($test->expectedException() !== null) {
                    throw new AssertionFailedError('Exception attendue non levée : ' . $test->expectedException());
                }

                ++$passed;
                ++$groups[$group]['passed'];
                $testResults[] = ['method' => $method, 'group' => $group, 'status' => 'VERT', 'detail' => 'Réussi'];
                echo "{$green}✅ VERT{$reset} — " . str_replace('_', ' ', substr($method, 5)) . "\n";
            } catch (\Throwable $exception) {
                $expected = $test->expectedException();
                if ($expected !== null && $exception instanceof $expected) {
                    ++$passed;
                    ++$groups[$group]['passed'];
                    $testResults[] = ['method' => $method, 'group' => $group, 'status' => 'VERT', 'detail' => 'Refus attendu correctement appliqué'];
                    echo "{$green}✅ VERT{$reset} — " . str_replace('_', ' ', substr($method, 5)) . " (refus attendu)\n";
                    continue;
                }

                ++$failed;
                ++$groups[$group]['failed'];
                $testResults[] = [
                    'method' => $method,
                    'group' => $group,
                    'status' => 'ROUGE',
                    'detail' => $exception::class . ': ' . $exception->getMessage(),
                ];
                echo "{$red}❌ ROUGE{$reset} — " . str_replace('_', ' ', substr($method, 5)) . "\n";
                echo "   " . $exception::class . ': ' . $exception->getMessage() . "\n";
            }
        }
    }

    ksort($groups);
    $duration = microtime(true) - $startedAt;

    $totalCases = 0;
    $applicableCases = 0;
    $replacedCases = 0;
    $coveredCases = 0;
    $missingCases = [];
    $caseErrors = [];
    $expectedCaseMethods = [];
    $orphanTests = [];
    if ($filter === null) {
        foreach (glob($projectRoot . '/tests/cases/CASE-*.md') ?: [] as $caseFile) {
            $caseContents = file_get_contents($caseFile);
            $caseName = basename($caseFile, '.md');
            ++$totalCases;

            if (preg_match('/^\*\*Statut\s*:\*\*\s*([^\r\n]+)/miu', $caseContents, $statusMatch) !== 1) {
                $caseErrors[] = "{$caseName} : statut absent";
                continue;
            }

            $status = trim(mb_strtolower($statusMatch[1]));
            if ($status === 'remplacé') {
                ++$replacedCases;
                if (preg_match('/^\*\*Amendé par\s*:\*\*\s*`([^`]+)`/miu', $caseContents, $replacementMatch) !== 1) {
                    $caseErrors[] = "{$caseName} : CASE remplaçant absent";
                    continue;
                }

                $replacementPath = $projectRoot . '/tests/cases/' . $replacementMatch[1] . '.md';
                if (!is_file($replacementPath)) {
                    $caseErrors[] = "{$caseName} : {$replacementMatch[1]} introuvable";
                    continue;
                }
                $replacementContents = file_get_contents($replacementPath);
                if (preg_match('/^\*\*Statut\s*:\*\*\s*applicable\s*$/miu', $replacementContents) !== 1) {
                    $caseErrors[] = "{$caseName} : {$replacementMatch[1]} n'est pas applicable";
                }
                continue;
            }

            if ($status !== 'applicable') {
                $caseErrors[] = "{$caseName} : statut inconnu « {$statusMatch[1]} »";
                continue;
            }

            ++$applicableCases;
            if (preg_match('/\*\*Nom attendu\s*:\*\*\s*`([^`]+)`/u', $caseContents, $methodMatch) !== 1) {
                $missingCases[] = "{$caseName} : nom de test attendu absent";
                continue;
            }

            $expectedMethod = $methodMatch[1];
            $expectedCaseMethods[$expectedMethod][] = $caseName;
            if (($executedMethods[$expectedMethod] ?? 0) === 1) {
                ++$coveredCases;
                continue;
            }
            $missingCases[] = isset($executedMethods[$expectedMethod])
                ? "{$caseName} : méthode {$expectedMethod} déclarée plusieurs fois"
                : "{$caseName} : méthode {$expectedMethod} introuvable";
        }

        foreach ($expectedCaseMethods as $method => $caseNames) {
            if (count($caseNames) > 1) {
                $caseErrors[] = $method . ' est revendiquée par plusieurs CASE : ' . implode(', ', $caseNames);
            }
        }
        foreach ($executedMethods as $method => $declarationCount) {
            if ($declarationCount > 1) {
                $caseErrors[] = $method . ' est déclarée dans plusieurs classes : ' . implode(', ', $methodOwners[$method]);
            }
            if (!isset($expectedCaseMethods[$method])) {
                $orphanTests[] = $method;
            }
        }
    }
    echo "\n{$bold}Récapitulatif par domaine{$reset}\n";
    foreach ($groups as $group => $result) {
        $total = $result['passed'] + $result['failed'];
        $color = $result['failed'] === 0 ? $green : $red;
        $status = $result['failed'] === 0 ? 'VERT' : 'ROUGE';
        echo sprintf("%s%-30s %s%s — %d/%d réussis%s\n", $cyan, $group, $color, $status, $result['passed'], $total, $reset);
    }

    if ($filter === null) {
        $coverageOk = $missingCases === [] && $caseErrors === [] && $orphanTests === [];
        $coverageColor = $coverageOk ? $green : $red;
        $coverageStatus = $coverageOk ? 'VERTE' : 'INCOMPLÈTE';
        echo sprintf(
            "\n%sInventaire CASE : %d applicable(s), %d remplacé(s), %d total%s\n",
            $bold,
            $applicableCases,
            $replacedCases,
            $totalCases,
            $reset,
        );
        echo sprintf(
            "%sCouverture des CASE applicables : %s%s — %d/%d automatisés%s\n",
            $bold,
            $coverageColor,
            $coverageStatus,
            $coveredCases,
            $applicableCases,
            $reset,
        );
        foreach ($missingCases as $missingCase) {
            echo "{$red}  - couverture manquante : {$missingCase}{$reset}\n";
        }
        foreach ($caseErrors as $caseError) {
            echo "{$red}  - métadonnée invalide : {$caseError}{$reset}\n";
        }
        foreach ($orphanTests as $orphanTest) {
            echo "{$red}  - test sans CASE applicable : {$orphanTest}{$reset}\n";
        }
    }

    $total = $passed + $failed;
    $allGreen = $failed === 0 && $missingCases === [] && $caseErrors === [] && $orphanTests === [];
    $summaryColor = $allGreen ? $green : $red;
    $summary = $allGreen ? 'TOUT EST VERT' : 'DES TESTS SONT ROUGES';
    echo sprintf(
        "\n%s%s%s — %d/%d tests réussis, %d échec(s), %.3f s%s\n",
        $bold,
        $summaryColor,
        $summary,
        $passed,
        $total,
        $failed,
        $duration,
        $reset,
    );

    if ($filter === null && $generateReport) {
        date_default_timezone_set(getenv('TZ') ?: 'Asia/Dubai');
        $reportDirectory = $projectRoot . '/docs/test-reports';
        if (!is_dir($reportDirectory)) {
            mkdir($reportDirectory, 0775, true);
        }

        $reportBaseName = 'rapport-tests-' . date('Y-m-d_H-i-s');
        $reportPath = $reportDirectory . '/' . $reportBaseName . '.md';
        $suffix = 2;
        while (file_exists($reportPath)) {
            $reportPath = $reportDirectory . '/' . $reportBaseName . '-' . $suffix . '.md';
            ++$suffix;
        }

        $markdown = [];
        $markdown[] = '# Rapport d’exécution des tests';
        $markdown[] = '';
        $markdown[] = '- **Date :** `' . date(DATE_ATOM) . '`';
        $markdown[] = '- **Commande :** `bash tools/run-tests.sh` ou `composer test`';
        $markdown[] = '- **Résultat :** ' . ($allGreen ? '✅ TOUT EST VERT' : '❌ DES TESTS SONT ROUGES');
        $markdown[] = '- **Tests :** ' . $passed . '/' . $total . ' réussis, ' . $failed . ' échec(s)';
        $markdown[] = '- **CASE applicables :** ' . $coveredCases . '/' . $applicableCases . ' automatisés';
        $markdown[] = '- **CASE remplacés :** ' . $replacedCases;
        $markdown[] = '- **CASE total :** ' . $totalCases;
        $markdown[] = '- **Durée :** ' . number_format($duration, 3, '.', '') . ' s';
        $markdown[] = '';
        $markdown[] = '## Récapitulatif par domaine';
        $markdown[] = '';
        $markdown[] = '| Domaine | Résultat | Réussis | Total |';
        $markdown[] = '|---|---:|---:|---:|';
        foreach ($groups as $group => $result) {
            $groupTotal = $result['passed'] + $result['failed'];
            $markdown[] = sprintf(
                '| %s | %s | %d | %d |',
                $group,
                $result['failed'] === 0 ? '✅ VERT' : '❌ ROUGE',
                $result['passed'],
                $groupTotal,
            );
        }
        $markdown[] = '';
        $markdown[] = '## Détail des tests';
        $markdown[] = '';
        $markdown[] = '| Test | Domaine | Résultat | Détail |';
        $markdown[] = '|---|---|---:|---|';
        foreach ($testResults as $result) {
            $detail = str_replace('|', '\\|', $result['detail']);
            $markdown[] = sprintf(
                '| `%s` | %s | %s | %s |',
                $result['method'],
                $result['group'],
                $result['status'] === 'VERT' ? '✅ VERT' : '❌ ROUGE',
                $detail,
            );
        }
        if ($missingCases !== []) {
            $markdown[] = '';
            $markdown[] = '## CASE applicables sans test';
            $markdown[] = '';
            foreach ($missingCases as $missingCase) {
                $markdown[] = '- `' . $missingCase . '`';
            }
        }
        if ($caseErrors !== []) {
            $markdown[] = '';
            $markdown[] = '## Métadonnées CASE invalides';
            $markdown[] = '';
            foreach ($caseErrors as $caseError) {
                $markdown[] = '- ' . $caseError;
            }
        }
        if ($orphanTests !== []) {
            $markdown[] = '';
            $markdown[] = '## Tests sans CASE applicable';
            $markdown[] = '';
            foreach ($orphanTests as $orphanTest) {
                $markdown[] = '- `' . $orphanTest . '`';
            }
        }
        $markdown[] = '';
        $markdown[] = '> Rapport généré automatiquement par `tools/test-runner.php`.';
        $markdown[] = '';

        file_put_contents($reportPath, implode("\n", $markdown));
        $relativeReportPath = substr($reportPath, strlen($projectRoot) + 1);
        echo "{$cyan}Trace Markdown générée : {$relativeReportPath}{$reset}\n";
    }

    exit($allGreen ? 0 : 1);
}
