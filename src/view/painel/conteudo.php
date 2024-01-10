<main>
    <div class="containe    r-fluid px-4">
        <h1 class="mt-4">Calendário</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Calendário / Mês</li>
        </ol>
        <div class="row">
            <div id="calendario"></div>
        </div>
    </div>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendario');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth'
        });
        calendar.setOption('locale', 'pt-br');
        calendar.render();
    });
</script>