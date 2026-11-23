# Changelog

All notable changes to this project are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [2.0.0] - 2026-11-23

### Added

- `Vector4` for homogeneous coordinates, with `fromVector3()`, `toVector3()` and `project()`.
- `isFinite()`, validated components (`InvalidComponentException`) and specific exceptions that implement `VectorException`.
- A documentation site at https://phpmath.github.io/vector/.

### Changed

- Vectors are immutable and float based, the namespace is now `PHPMath\Vector`.
- Requires PHP 8.4 or newer.
- `angleBetween()` is numerically stable, `normalize()` works for very large and very small vectors, and results never contain a negative zero.
- `toString()` prints plain decimals.

### Removed

- `Tuple`, `VectorUtils` and the dependency on `phpmath/bignumber`.
- The aliases `conjugate()`, `reverse()` and `getMagnitude()`.

Earlier versions are described on the [releases page](https://github.com/phpmath/vector/releases).

[Unreleased]: https://github.com/phpmath/vector/compare/2.0.0...HEAD
[2.0.0]: https://github.com/phpmath/vector/compare/1.0.0...2.0.0
