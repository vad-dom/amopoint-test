<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Visit Statistics
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Unique visits by hour</h3>
                <canvas id="visitsByHourChart"></canvas>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Visits by city</h3>
                <canvas id="visitsByCityChart"></canvas>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const visitsByHourLabels = @json($visitsByHour->pluck('hour'));
        const visitsByHourData = @json($visitsByHour->pluck('visits_count'));

        const visitsByCityLabels = @json($visitsByCity->pluck('city'));
        const visitsByCityData = @json($visitsByCity->pluck('visits_count'));

        new Chart(document.getElementById('visitsByHourChart'), {
            type: 'bar',
            data: {
                labels: visitsByHourLabels,
                datasets: [{
                    label: 'Unique visits',
                    data: visitsByHourData,
                }]
            },
        });

        new Chart(document.getElementById('visitsByCityChart'), {
            type: 'pie',
            data: {
                labels: visitsByCityLabels,
                datasets: [{
                    label: 'Visits',
                    data: visitsByCityData,
                }]
            },
        });
    </script>
</x-app-layout>
