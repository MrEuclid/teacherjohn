<?php

/**
 * Calculates deterministic customer demand and actual sales 
 * for the mango smoothie simulation.
 *
 * @param float $price_set The price chosen by the student.
 * @param int $mangoes_in_stock The current inventory of mangoes.
 * @param int $cups_in_stock The current inventory of cups.
 * @return array Contains demand, actual sales, inventory status, and revenue.
 */
function runMarketSimulation($price_set, $mangoes_in_stock, $cups_in_stock) {
    
    // 1. Market Constants (e.g., a busy spot on Riverside)
    $max_foot_traffic = 120;   // The theoretical max customers (Q_max)
    $max_willing_price = 4.50; // The price at which demand hits exactly 0 (P_max)
    $daily_sales_capacity = 80; // Max smoothies one person can physically blend in a day

    // 2. Calculate Deterministic Demand
    // Formula: Qd = Qmax * (1 - (Price / Pmax))
    if ($price_set >= $max_willing_price) {
        $customer_demand = 0;
    } else {
        $customer_demand = $max_foot_traffic * (1 - ($price_set / $max_willing_price));
    }

    // Round to the nearest whole person (we can't have half a customer)
    $customer_demand = (int) round($customer_demand);

    // 3. Apply Operational Constraints
    // Students cannot sell more than they have, more than they can blend, or more than demand.
    $max_possible_inventory = min($mangoes_in_stock, $cups_in_stock);
    
    $actual_sales = min($customer_demand, $max_possible_inventory, $daily_sales_capacity);

    // 4. Calculate Financial & Inventory Outcomes
    $total_revenue = $actual_sales * $price_set;
    $leftover_mangoes = $mangoes_in_stock - $actual_sales;
    $leftover_cups = $cups_in_stock - $actual_sales;

    // 5. Package the Results for the End of Week Report
    return [
        'success'          => true,
        'message'          => "Well done! The market day has concluded. Review your report to record your entries.",
        'price_set'        => number_format($price_set, 2),
        'customer_demand'  => $customer_demand,
        'actual_sales'     => $actual_sales,
        'total_revenue'    => number_format($total_revenue, 2),
        'leftover_mangoes' => $leftover_mangoes,
        'leftover_cups'    => $leftover_cups
    ];
}

?>