import React from 'react';


const JSONModal = ({ isOpen , onClose }) => {
    if (!isOpen) return null;

    const json = '[{"id": 1,"produto": "Arroz","preco": 5.00},{"id": 2,"produto": "Feijão","preco": 7.00},{"id": 3,"produto": "Macarrão","preco":   3.00}]';


    return (
        <div className="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75">
            <div className="bg-white w-1/3 p-10 rounded-lg">
                <h2 className="text-2xl font-bold mb-4">JSON</h2>
                <div className="mb-4">
                    <p>{json}</p>
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
