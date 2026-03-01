<script>
function continuedFraction(cf) {
  // Initialize variables for numerator and denominator
  let numerator = cf[cf.length - 1];
  let denominator = 1;

  // Iterate through the continued fraction list in reverse order
  for (let i = cf.length - 2; i >= 0; i--) {
    // Update numerator and denominator using recursion
    const temp = numerator;
    numerator = denominator;
    denominator = temp + cf[i] * denominator;
  }

  // Return the final fraction
  return numerator / denominator;
}

// Continued fraction representation
const cf = [3, 7, 15, 1];

// Evaluate the continued fraction
const result = continuedFraction(cf);

// Print the result
console.log(result);
</script>

