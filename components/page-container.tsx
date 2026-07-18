import type { ReactNode } from "react";

import { cn } from "@/lib/utils";

type PageContainerProps = {
  children: ReactNode;
  className?: string;
  width?: "md" | "lg" | "xl";
  id?: string;
};

const widths = {
  md: "max-w-3xl",
  lg: "max-w-5xl",
  xl: "max-w-6xl",
};

export function PageContainer({
  children,
  className,
  width = "xl",
  id,
}: PageContainerProps) {
  return (
    <div id={id} className={cn("mx-auto w-full px-4 sm:px-6", widths[width], className)}>
      {children}
    </div>
  );
}
