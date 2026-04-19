/**
 * Efficiently computes all primitive roots of a small prime number p.
 */
function getPrimitiveRoots(p) {
    if (!isPrime(p)) return [];

    const phi = p - 1;
    const factors = getPrimeFactors(phi);
    const roots = [];

    // Check each candidate from 2 to p-1
    for (let g = 2; g < p; g++) {
        let isPrimitive = true;
        
        // For a primitive root, g^(phi/f) mod p != 1 for all prime factors f of phi
        for (let f of factors) {
            if (powerMod(g, phi / f, p) === 1) {
                isPrimitive = false;
                break;
            }
        }
        
        if (isPrimitive) roots.push(g);
    }
    return roots;
}

// Modular Exponentiation: (base^exp) % mod
function powerMod(base, exp, mod) {
    let res = 1;
    base = base % mod;
    while (exp > 0) {
        if (exp % 2 === 1) res = (res * base) % mod;
        base = (base * base) % mod;
        exp = Math.floor(exp / 2);
    }
    return res;
}

// Get unique prime factors of n
function getPrimeFactors(n) {
    const factors = new Set();
    while (n % 2 === 0) { factors.add(2); n /= 2; }
    for (let i = 3; i * i <= n; i += 2) {
        while (n % i === 0) { factors.add(i); n /= i; }
    }
    if (n > 2) factors.add(n);
    return Array.from(factors);
}

// Basic primality test
function isPrime(n) {
    if (n < 2) return false;
    for (let i = 2; i * i <= n; i++) {
        if (n % i === 0) return false;
    }
    return true;
}

// Example usage: Find primitive roots for 7
console.log(getPrimitiveRoots(7)); // Output: [3, 5]
