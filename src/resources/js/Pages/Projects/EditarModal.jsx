import React, { useEffect } from 'react';
import { useForm, router } from "@inertiajs/react";
import { toast } from 'react-toastify'

const EditarModal = ({isOpen, onClose, projeto}) => {
    if (!isOpen) return null;

    const {
        data,
        setData,
    } = useForm({
        titulo: "",
        url_padrao: "",
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
        router.put(`/projetos/${data.id}` , {
            titulo: data.titulo,
            url_padrao: data.url_padrao,
        });

        toast.success('Projeto Alterado com Sucesso!')

        onClose();
    };


    useEffect(() => {
        setData({...projeto})
    }, [projeto]);

    return (
        <div className="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75">
            <div className="bg-white w-1/3 p-8 rounded-lg">
                <h2 className="text-2xl font-bold mb-4">Editar Projeto</h2>
                <form onSubmit={handleSubmit}>
                    <div className="mb-4">
                        <label htmlFor="id" className="block text-gray-800 font-bold mb-2">ID</label>
                        <input type="text" value={data.id} id="id" name="id" className="w-full bg-slate-100 border border-gray-300 p-2 rounded-lg"
                            readOnly required/>
                    </div>
                    <div className="mb-4">
                        <label htmlFor="titulo" className="block text-gray-800 font-bold mb-2">Titulo</label>
                        <input type="text" value={data.titulo} onChange={handleChange} id="titulo" name="titulo" className="w-full border border-gray-300 p-2 rounded-lg" required />
                    </div>
                    <div className="mb-4">
                        <label htmlFor="url_padrao" className="block text-gray-800 font-bold mb-2">URL</label>
                        <input type="text" value={data.url_padrao}  onChange={handleChange} id="url_padrao" name="url_padrao" className="w-full border border-gray-300 p-2 rounded-lg" required />
                    </div>
                    <div className="flex justify-between">
                        <button type="submit" className="bg-indigo-600 hover:bg-indigo-800 text-white font-bold py-2 px-4 rounded">
                            Salvar
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

export default EditarModal;
