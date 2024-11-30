document.addEventListener('DOMContentLoaded', () => {
    const talentosInput = document.getElementById('talentos-input');
    const talentosTags = document.getElementById('talentos-tags');
    const talentosHidden = document.getElementById('talentos');

    let tags = [];

    // Crear una etiqueta visual y agregarla a la lista
    function createTag(text) {
        const tag = document.createElement('span');
        tag.classList.add('tag');
        tag.textContent = `#${text}`;
        
        // Botón para eliminar etiqueta
        const removeBtn = document.createElement('button');
        removeBtn.classList.add('remove');
        removeBtn.textContent = 'x';
        removeBtn.onclick = () => {
            tags = tags.filter(t => t !== text);
            updateHiddenInput();
            tag.remove();
        };

        tag.appendChild(removeBtn);
        talentosTags.appendChild(tag);
    }

    // Actualizar input oculto con todas las etiquetas
    function updateHiddenInput() {
        talentosHidden.value = tags.join(',');
    }

    // Detectar entrada y creación de etiquetas
    talentosInput.addEventListener('keypress', (event) => {
        if (event.key === 'Enter' && talentosInput.value.trim() !== '') {
            event.preventDefault();
            const value = talentosInput.value.trim().toLowerCase();

            if (value && !tags.includes(value)) {
                tags.push(value);
                createTag(value);
                updateHiddenInput();
            }

            talentosInput.value = ''; // Limpiar el campo
        }
    });

    // Prevenir caracteres especiales no deseados en la entrada
    talentosInput.addEventListener('input', () => {
        talentosInput.value = talentosInput.value.replace(/[^a-zA-Z0-9\s]/g, '');
    });
});
