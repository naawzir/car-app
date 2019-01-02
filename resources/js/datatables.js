/**
 * Refresh the list
 *
 * @param dataTableItems - Object Array with the datatable options. Uses the following format:
 */

window.makeDatatable = (dataTableItems) => {
    dataTableItems.forEach((dataTableItem) => {
        if (!dataTableItem.url) {
            return; // No data
        }

        const paginationClass = `.${dataTableItem.dataTableID.substring(1)}-page-button`;
        let noDraw = false;
        const deferLoadingVar = dataTableItem.deferLoading !== undefined ? dataTableItem.deferLoading : null;
        const domVar = dataTableItem.dom !== undefined ? dataTableItem.dom : `l<r>t<i<"${paginationClass}"p>>`;
        const buttonsVar = dataTableItem.buttons !== undefined ? dataTableItem.buttons : [];
        const defaultOrder = dataTableItem.ordering !== undefined ? dataTableItem.ordering : [[0, 'asc']];
        const defaultLengthMenu = dataTableItem.lengthmenu !== undefined ? dataTableItem.lengthmenu : [[10, 25, 50, 100], [10, 25, 50, 100]];
        const defaultdisplayLength = dataTableItem.displaylength !== undefined ? dataTableItem.displaylength : 10;

        const dataTable = $(dataTableItem.dataTableID).DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            stateDuration: -1,
            stripeClasses: '',
            lengthMenu: defaultLengthMenu,
            pageLength: defaultdisplayLength,
            order: defaultOrder,
            ajax: dataTableItem.url,
            columns: dataTableItem.cols,
            stateSave: dataTableItem.stateSave,
            dom: domVar,
            buttons: buttonsVar,
            drawCallback() {
                if (dataTableItem.stateSave) {
                    $(paginationClass).find('a.paginate_button').on('click', () => {
                        noDraw = true;
                        const dtInfo = dataTable.page.info();
                        sessionStorage.setItem(`${dataTableItem.dataTableID.substring(1)}page`, dtInfo.page);
                    });
                }
            },
            initComplete() {
                if (dataTableItem.stateSave) {
                    const dtPage = parseInt(sessionStorage.getItem(`${dataTableItem.dataTableID.substring(1)}page`), 10);
                    if ((!noDraw && deferLoadingVar === null) && (dtPage !== null && dtPage !== false && !Number.isNaN(dtPage))) {
                        dataTable.page(dtPage).draw('page');
                    }
                }
            },
            deferLoading: deferLoadingVar,
        });
    });
};
