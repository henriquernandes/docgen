import React from 'react';
import { useForm, router, usePage } from "@inertiajs/react";
import { toast } from 'react-toastify'
import InputError from "@/Components/InputError.jsx";

const CriarModal = ({ isOpen , onClose }) => {
    if (!isOpen) return null;

    const {
        data,
        setData,
        errors,
    } = useForm({
        titulo: "",
        url_padrao: "",
        limite_usuarios: "",
    });

    const handleChange = (props) => {
        const {
            target: { value, id },
        } = props;

        setData({
            ...data,
            [id]: value,
        });
    };

    const handleSubmit = (e) => {
        e.preventDefault();

        router.post('/projetos', {
            titulo: data.titulo,
            limite_usuarios: data.limite_usuarios,
            url_padrao: data.url_padrao,
        });

        toast.success('Projeto Criado com sucesso!');
        onClose();
    };

    return (
        <div className="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75">
            <div className="bg-white w-1/3 p-10 rounded-lg">
                <h2 className="text-2xl font-bold mb-4">Criar Projeto</h2>
                <form onSubmit={handleSubmit}>
                    <div className="mb-4">
                        <label htmlFor="titulo" className="block text-gray-800 font-bold mb-2">Titulo</label>
                        <input type="text" id="titulo" value={data.titulo} name="titulo" className="w-full border border-gray-300 p-2 rounded-lg" onChange={handleChange} required />
                    </div>
                    <div className="mb-4">
                        <label htmlFor="url" className="block text-gray-800 font-bold mb-2">URL</label>
                        <input type="text" id="url_padrao" value={data.url_padrao} name="url_padrao" className="w-full border border-gray-300 p-2 rounded-lg" onChange={handleChange} required />
                    </div>
                    <div className="flex justify-between">
                        <button type="submit" className="bg-indigo-600 hover:bg-indigo-800 text-white font-bold py-2 px-4 rounded" >
                            Criar
                        </button>
                        <button className="bg-red-700 hover:bg-red-900 text-white font-bold py-2 px-4 rounded ml-2 " onClick={onClose}>
                            Sair
                        </button>
                    </div>
                </form>
            </div>
        </div>
    );
};

export default CriarModal;
