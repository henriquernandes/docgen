import { router, useForm } from "@inertiajs/react";
import React from "react";
import SuccessButton from "./SuccessButton";
import DangerButton from "./DangerButton";

function ImportSection({projeto_id}) {
    const { data, setData, post, progress, errors } = useForm({
        arquivo: "",
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        router.post(`/importar/${projeto_id}`, data);
    };

    const handleExport = (e) => {
        e.preventDefault();
        window.open(`/exportar/${projeto_id}`)
    };

    return (
        <div className="flex-col gap-2">
            <input
                className="border border-gray-300 rounded-md w-full"
                type="file"
                onChange={(e) => {
                    setData("arquivo", e.target.files[0]);
                }}
            />
            <div className="py-2"></div>
            {progress && (
                <progress value={progress.percentage} max="100">
                    {progress.percentage}%
                </progress>
            )}
            <div className="flex gap-4">
                <SuccessButton
                    onClick={handleSubmit}
                >
                    Importar
                </SuccessButton>
                <DangerButton
                    onClick={handleExport}
                >
                    Gerar
                </DangerButton>
            </div>
        </div>
    );
}

export default ImportSection;
