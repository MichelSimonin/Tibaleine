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
    foreach (array_slice($argv, 1) as $argument) {
        if (str_starts_with($argument, '--filter=')) {
            $filter = substr($argument, 9);
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
            $executedMethods[$method] = true;
            $test = new $testClass();

            try {
                $test->{$method}();
                if ($test->expectedException() !== null) {
                    throw new AssertionFailedError('Exception attendue non levée : ' . $test->expectedException());
                }

                ++$passed;
                ++$groups[$group]['passed'];
                echo "{$green}✅ VERT{$reset} — " . str_replace('_', ' ', substr($method, 5)) . "\n";
            } catch (\Throwable $exception) {
                $expected = $test->expectedException();
                if ($expected !== null && $exception instanceof $expected) {
                    ++$passed;
                    ++$groups[$group]['passed'];
                    echo "{$green}✅ VERT{$reset} — " . str_replace('_', ' ', substr($method, 5)) . " (refus attendu)\n";
                    continue;
                }

                ++$failed;
                ++$groups[$group]['failed'];
                echo "{$red}❌ ROUGE{$reset} — " . str_replace('_', ' ', substr($method, 5)) . "\n";
                echo "   " . $exception::class . ': ' . $exception->getMessage() . "\n";
            }
        }
    }

    ksort($groups);
    $duration = microtime(true) - $startedAt;

    $applicableCases = 0;
    $coveredCases = 0;
    $missingCases = [];
    if ($filter === null) {
        foreach (glob($projectRoot . '/tests/cases/CASE-*.md') ?: [] as $caseFile) {
            $caseContents = file_get_contents($caseFile);
            if (!str_contains($caseContents, '**Statut :** applicable')) {
                continue;
            }
            ++$applicableCases;
            if (preg_match('/\*\*Nom attendu\s*:\*\*\s*`([^`]+)`/u', $caseContents, $methodMatch) === 1
                && isset($executedMethods[$methodMatch[1]])) {
                ++$coveredCases;
                continue;
            }
            $missingCases[] = basename($caseFile, '.md');
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
        $coverageColor = $missingCases === [] ? $green : $red;
        $coverageStatus = $missingCases === [] ? 'VERTE' : 'INCOMPLÈTE';
        echo sprintf(
            "\n%sCouverture des CASE applicables : %s%s — %d/%d automatisés%s\n",
            $bold,
            $coverageColor,
            $coverageStatus,
            $coveredCases,
            $applicableCases,
            $reset,
        );
        foreach ($missingCases as $missingCase) {
            echo "{$red}  - test manquant : {$missingCase}{$reset}\n";
        }
    }

    $total = $passed + $failed;
    $allGreen = $failed === 0 && $missingCases === [];
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

    exit($allGreen ? 0 : 1);
}
