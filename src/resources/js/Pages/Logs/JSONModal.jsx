import React from 'react';
import JsonFormatter from 'react-json-formatter'


const JSONModal = ({ isOpen , onClose, json }) => {
    if (!isOpen) return null;

    const jsonStyle = {
        propertyStyle: { color: 'red' },
        stringStyle: { color: 'green' },
        numberStyle: { color: 'darkorange' }
      }
    return (
        <div className="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75">
            <div className="bg-white w-1/3 p-10 rounded-lg">
                <h2 className="text-2xl font-bold mb-4">JSON</h2>
                <div className="mb-4 overflow-y-auto max-h-[80vh]">
                    <JsonFormatter json={json} tabWith={4} jsonStyle={jsonStyle} />
                </div>
                <div className="flex justify-between">
                    <button className="bg-red-700 hover:bg-red-900 text-white font-bold py-2 px-4 rounded ml-2 " onClick={onClose}>
                        Sair
                    </button>
                </div>
            </div>
        </div>
    );
};

export default JSONModal;
