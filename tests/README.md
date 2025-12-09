# Testing Documentation

## Overview
This directory contains comprehensive unit and feature tests for the Gereja Management System.

## Test Structure

### Unit Tests (`tests/Unit/`)
- **Models/AnggotaPelkaTest.php**: Tests for AnggotaPelka model relationships and CRUD operations
- **Models/DokumenTest.php**: Tests for Dokumen model, file handling, and relationships
- **Widgets/JemaatOverviewTableTest.php**: Tests for the Jemaat overview table widget

### Feature Tests (`tests/Feature/`)
- **JemaatReportTest.php**: Tests for PDF report generation functionality
- **DokumenUploadTest.php**: Tests for document upload functionality (Baptis & Sidi)

## Running Tests

### Run All Tests
```bash
php artisan test
```

### Run Specific Test Suite
```bash
# Run only unit tests
php artisan test --testsuite=Unit

# Run only feature tests
php artisan test --testsuite=Feature
```

### Run Specific Test File
```bash
php artisan test tests/Unit/Models/AnggotaPelkaTest.php
```

### Run Specific Test Method
```bash
php artisan test --filter=it_can_upload_baptis_document
```

### Run with Coverage
```bash
php artisan test --coverage
```

## Test Coverage

### Models Tested
- ✅ AnggotaPelka (relationships, CRUD)
- ✅ Dokumen (file upload, relationships)
- ✅ Kelompok (via factories)
- ✅ Pelka (via factories)
- ✅ AnggotaKeluarga (via factories)

### Features Tested
- ✅ PDF Report Generation
- ✅ Document Upload (Baptis & Sidi)
- ✅ Authentication & Authorization
- ✅ File Storage
- ✅ Widget Data Loading

### Controllers Tested
- ✅ JemaatReportController (PDF download)

## Factories

All models have factories for easy test data generation:

```php
// Create single record
$anggotaPelka = AnggotaPelka::factory()->create();

// Create multiple records
$dokumens = Dokumen::factory()->count(5)->create();

// Create with specific attributes
$dokumen = Dokumen::factory()->baptis()->create([
    'anggota_keluarga_id' => $anggotaKeluarga->id
]);
```

## Test Database

Tests use SQLite in-memory database by default. Configuration in `phpunit.xml`:

```xml
<env name="DB_CONNECTION" value="sqlite"/>
<env name="DB_DATABASE" value=":memory:"/>
```

## Best Practices

1. **Use RefreshDatabase**: Always use `RefreshDatabase` trait to ensure clean database state
2. **Descriptive Test Names**: Use `it_` prefix for test method names
3. **Arrange-Act-Assert**: Follow AAA pattern in tests
4. **Factory Usage**: Use factories instead of manual model creation
5. **Fake Storage**: Use `Storage::fake()` for file upload tests

## Continuous Integration

Add to your CI/CD pipeline:

```yaml
# .github/workflows/tests.yml
- name: Run Tests
  run: php artisan test --parallel
```

## Troubleshooting

### Database Issues
```bash
# Clear and refresh test database
php artisan migrate:fresh --env=testing
```

### Cache Issues
```bash
# Clear all caches
php artisan optimize:clear
```

### Permission Issues
```bash
# Fix storage permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

## Adding New Tests

1. Create test file in appropriate directory
2. Extend `Tests\TestCase`
3. Use `RefreshDatabase` trait
4. Write descriptive test methods
5. Run tests to verify

Example:
```php
<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_does_something()
    {
        // Arrange
        $model = Model::factory()->create();

        // Act
        $result = $model->doSomething();

        // Assert
        $this->assertTrue($result);
    }
}
```