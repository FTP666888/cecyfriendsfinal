document.addEventListener('DOMContentLoaded', () => {
    const handleAction = async (matchId, action) => {
        try {
            const response = await fetch('../php/actions/handleInterest.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ matchId, action }),
            });

            const result = await response.json();
            if (result.success) {
                alert(result.message);
                // Recargar la página para actualizar el estado
                location.reload();
            } else {
                alert(result.message);
            }
        } catch (error) {
            alert('Ocurrió un error, por favor intenta nuevamente.');
        }
    };

    document.querySelectorAll('.btn-accept').forEach((button) =>
        button.addEventListener('click', (e) => {
            const matchId = e.target.dataset.id;
            handleAction(matchId, 'accept');
        })
    );

    document.querySelectorAll('.btn-reject').forEach((button) =>
        button.addEventListener('click', (e) => {
            const matchId = e.target.dataset.id;
            handleAction(matchId, 'reject');
        })
    );
});