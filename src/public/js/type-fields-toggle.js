(() => {
    const typeSelect = document.querySelector('select');

    if (!typeSelect) {
        return;
    }

    const fields = Array.from(document.querySelectorAll('input[name], textarea[name], select[name]'))
        .filter((field) => field !== typeSelect && field.type !== 'button' && field.type !== 'submit');

    const getNameParts = (name) => name.split(/[^a-zA-Z0-9]+/).filter(Boolean);

    const getWrapper = (field) => field.closest('p, div, label, tr') ?? field;

    const setVisible = (field, visible) => {
        const wrapper = getWrapper(field);

        wrapper.style.display = visible ? '' : 'none';

        const nextElement = wrapper.nextElementSibling;

        if (
            nextElement
            && nextElement.tagName === 'P'
            && nextElement.innerHTML.trim() === '&nbsp;'
        ) {
            nextElement.style.display = visible ? '' : 'none';
        }
    };

    const updateVisibleFields = () => {
        const selectedType = typeSelect.value;

        fields.forEach((field) => {
            const nameParts = getNameParts(field.name);
            const shouldShow = nameParts.includes(selectedType);

            setVisible(field, shouldShow);
        });
    };

    typeSelect.addEventListener('change', updateVisibleFields);

    updateVisibleFields();
})();
